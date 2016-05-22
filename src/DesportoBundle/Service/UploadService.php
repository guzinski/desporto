<?php

namespace DesportoBundle\Service;

use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of Upload
 *
 * @author Luciano
 */
class UploadService
{
    protected $allowedExtensions = array();
    protected $sizeLimit = null;
    protected $inputName = 'file';
    protected $chunksFolder = 'chunks';

    protected $chunksCleanupProbability = 0.001; // Once in 1000 requests on avg
    protected $chunksExpireIn = 604800; // One week

    protected $uploadName;

    protected $requestStack;

    public function __construct(RequestStack $requestStack)
    {
        $this->requestStack = $requestStack;
    }

    /**
     * Get the original filename
     */
    public function getName() {
        if (isset($_FILES[$this->inputName]))
            return $this->sanitizeString($_FILES[$this->inputName]['name']);
    }

    public function getInitialFiles() {
        $initialFiles = array();

        for ($i = 0; $i < 5000; $i++) {
            array_push($initialFiles, array("name" => "name" + $i, uuid => "uuid" + $i, thumbnailUrl => "/test/dev/handlers/vendor/fineuploader/php-traditional-server/fu.png"));
        }

        return $initialFiles;
    }

    /**
     * Get the name of the uploaded file
     */
    public function getUploadName(){
        return $this->uploadName;
    }

    public function combineChunks($uploadDirectory) {
        $uuid = $this->requestStack->getCurrentRequest()->get('qquuid');
        $name = $this->getName();
        $targetFolder = $uploadDirectory.DIRECTORY_SEPARATOR.$this->chunksFolder.DIRECTORY_SEPARATOR.$uuid;
        $totalParts = $this->requestStack->getCurrentRequest()->request->getInt('qqtotalparts', 1);
        if ($totalParts === 1) {
            return array("success" => true, "uuid" => $uuid);
        }
        $targetPath = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $uuid, $name));
        $this->uploadName = $name;

        if (!file_exists($targetPath)){
            mkdir(dirname($targetPath));
        }
        
        if ($totalParts>1) {
            $target = fopen($targetPath, 'wb');

            for ($i=0; $i<$totalParts; $i++){
                $chunk = fopen($targetFolder.DIRECTORY_SEPARATOR.$i, "rb");
                stream_copy_to_stream($chunk, $target);
                fclose($chunk);
            }

            // Success
            fclose($target);

            for ($i=0; $i<$totalParts; $i++){
                unlink($targetFolder.DIRECTORY_SEPARATOR.$i);
            }
        } else {
            rename($targetFolder.DIRECTORY_SEPARATOR.$name, $targetPath);
            unlink($targetFolder.DIRECTORY_SEPARATOR.$name);
        }

        rmdir($targetFolder);

        if (!is_null($this->sizeLimit) && filesize($targetPath) > $this->sizeLimit) {
            unlink($targetPath);
            http_response_code(413);
            return array("success" => false, "uuid" => $uuid, "preventRetry" => true);
        }

        return array("success" => true, "uuid" => $uuid);
    }

    /**
     * Process the upload.
     * @param string $uploadDirectory Target directory.
     * @param string $name Overwrites the name of the file.
     */
    public function handleUpload($uploadDirectory, $name = null)
    {
        if ($this->isInaccessible($uploadDirectory)){
            return array('error' => "Erro no Servidor. Falha ao enviar o Arquivo");
        }

        $type = $_SERVER['CONTENT_TYPE'];
        if (isset($_SERVER['HTTP_CONTENT_TYPE'])) {
            $type = $_SERVER['HTTP_CONTENT_TYPE'];
        }

        if(!isset($type)) {
            return array('error' => "No files were uploaded.");
        } else if (strpos(strtolower($type), 'multipart/') !== 0){
            return array('error' => "Erro no Servidor. Esse formulário não está preparado para enviar arquivos.");
        }

        // Get size and name
        $file = $_FILES[$this->inputName];
        $size = $file['size'];

        if ($name === null){
            $name = $this->getName();
        }

        // Validate name
        if (empty($name)) {
            return array('error' => 'Arquivo sem nome.');
        }

        // Validate file size
        if ($size == 0) {
            return array('error' => 'Arquivo Vazio.');
        }

        if (!is_null($this->sizeLimit) && $size > $this->sizeLimit) {
            return array('error' => 'Arquivo muito grande.', 'preventRetry' => true);
        }

        // Validate file extension
        $pathinfo = pathinfo($file['name']);
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';

        
        $name = preg_replace("/({$ext})$/i", "", $name).".".$ext;
        
        if($this->allowedExtensions && !in_array(strtolower($ext), array_map("strtolower", $this->allowedExtensions))){
            $these = implode(', ', $this->allowedExtensions);
            return array('error' => 'Tipo de aruqivo inválido, O arquivos deve ser do tipo '. $these . '.');
        }

        // Save a chunk

        # non-chunked upload

        $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $name));

        if ($target) {
            $this->uploadName = basename($target);
            $arquivo = $name;
            if (!is_dir(dirname($target))) {
                mkdir(dirname($target));
            }
            
            $i = 1;
            while (file_exists($target)) {
                $i++; $arquivo = preg_replace("/(.{$ext})$/i", "", $name)."(".$i.").".$ext;
                $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $arquivo));
            }

            if (move_uploaded_file($file['tmp_name'], $target)){
                return array('success'=> true, 'fileName'=>$arquivo);
            }
        }

        return array('error'=> 'Could not save uploaded file.' .
            'The upload was cancelled, or server error encountered');
    }

    /**
     * Process a delete.
     * @param string $uploadDirectory Target directory.
     * @params string $name Overwrites the name of the file.
     *
     */
    public function handleDelete($uploadDirectory)
    {
        if ($this->isInaccessible($uploadDirectory)) {
            return array('error' => "Erro no servidor. Falha ao enviar arquivo");
        }
        $name = $this->requestStack->getCurrentRequest()->get("id");

        if (empty($name)) {
            return array("success" => false,
                "error" => "Nome do Arquivo está vazio.");
        }
        
        $target = join(DIRECTORY_SEPARATOR, array($uploadDirectory, $name));

        if (file_exists($target)) { 
            unlink($target);
            return array("success" => true);
        } else {
            return array("success" => false,
                "error" => "Arquivo não encontrado! Não foi possível deletar o Arquivo.");
        }

    }

    /**
     * Returns a path to use with this upload. Check that the name does not exist,
     * and appends a suffix otherwise.
     * @param string $uploadDirectory Target directory
     * @param string $filename The name of the file to use.
     */
    protected function getUniqueTargetPath($uploadDirectory, $filename)
    {
        // Allow only one process at the time to get a unique file name, otherwise
        // if multiple people would upload a file with the same name at the same time
        // only the latest would be saved.

        if (function_exists('sem_acquire')){
            $lock = sem_get(ftok(__FILE__, 'u'));
            sem_acquire($lock);
        }

        $pathinfo = pathinfo($filename);
        $base = $pathinfo['filename'];
        $ext = isset($pathinfo['extension']) ? $pathinfo['extension'] : '';
        $ext = $ext == '' ? $ext : '.' . $ext;

        $unique = $base;
        $suffix = 0;

        // Get unique file name for the file, by appending random suffix.

        while (file_exists($uploadDirectory . DIRECTORY_SEPARATOR . $unique . $ext)){
            $suffix += rand(1, 999);
            $unique = $base.'-'.$suffix;
        }

        $result =  $uploadDirectory . DIRECTORY_SEPARATOR . $unique . $ext;

        // Create an empty target file
        if (!touch($result)){
            // Failed
            $result = false;
        }

        if (function_exists('sem_acquire')){
            sem_release($lock);
        }

        return $result;
    }

    /**
     * Deletes all file parts in the chunks folder for files uploaded
     * more than chunksExpireIn seconds ago
     */
    protected function cleanupChunks(){
        foreach (scandir($this->chunksFolder) as $item){
            if ($item == "." || $item == "..")
                continue;

            $path = $this->chunksFolder.DIRECTORY_SEPARATOR.$item;

            if (!is_dir($path))
                continue;

            if (time() - filemtime($path) > $this->chunksExpireIn){
                $this->removeDir($path);
            }
        }
    }

    /**
     * Removes a directory and all files contained inside
     * @param string $dir
     */
    protected function removeDir($dir){
        foreach (scandir($dir) as $item){
            if ($item == "." || $item == "..")
                continue;

            if (is_dir($item)){
                $this->removeDir($item);
            } else {
                unlink(join(DIRECTORY_SEPARATOR, array($dir, $item)));
            }

        }
        rmdir($dir);
    }

    /**
     * Converts a given size with units to bytes.
     * @param string $str
     */
    protected function toBytes($str){
        $val = trim($str);
        $last = strtolower($str[strlen($str)-1]);
        switch($last) {
            case 'g': $val *= 1024;
            case 'm': $val *= 1024;
            case 'k': $val *= 1024;
        }
        return $val;
    }

    /**
     * Determines whether a directory can be accessed.
     *
     * is_executable() is not reliable on Windows prior PHP 5.0.0
     *  (http://www.php.net/manual/en/function.is-executable.php)
     * The following tests if the current OS is Windows and if so, merely
     * checks if the folder is writable;
     * otherwise, it checks additionally for executable status (like before).
     *
     * @param string $directory The target directory to test access
     */
    protected function isInaccessible($directory) {
        $isWin = $this->isWindows();
        $folderInaccessible = ($isWin) ? !is_writable($directory) : ( !is_writable($directory) && !is_executable($directory) );
        return $folderInaccessible;
    }

    /**
     * Determines is the OS is Windows or not
     *
     * @return boolean
     */

    protected function isWindows() {
    	$isWin = (strtoupper(substr(PHP_OS, 0, 3)) === 'WIN');
    	return $isWin;
    }
    
    protected function sanitizeString($str)
    {
        return preg_replace('{\W}', '', preg_replace('{ +}', '_', strtr(
            utf8_decode(html_entity_decode($str)),
            utf8_decode('ÀÁÃÂÉÊÍÓÕÔÚÜÇÑàáãâéêíóõôúüçñ'),
            'AAAAEEIOOOUUCNaaaaeeiooouucn')));
    }
    
    public function download($file) {
        if (!file_exists($file)) {
            throw new NotFoundHttpException;
        }
        $response = new Response(file_get_contents($file));
       
        $file = new File($file);
        $response->headers->set('Content-Type', $file->getMimeType());
        $response->headers->set("Content-Length", $file->getSize());
        return $response;
    }
    
    public function getRealName($name, $path)
    {
        $i = 0;
        $originalName = $name;
        while (file_exists($path.$name)) {
            $extensao = array_reverse(explode(".", $originalName))[0]; $i++;
            $name = str_replace(".".$extensao, "", $originalName)."(".$i.").".$extensao;
        }
        return $name;
    }

}
