<?php

namespace DesportoBundle\Service;

use AppKernel;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use DesportoBundle\Entity\Dependente;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of Profissional
 *
 * @author Luciano
 */
class ProfissionalService
{
    /**
     *
     * @var RequestStack 
     */
    protected $requestStack;
    /**
     *
     * @var AppKernel 
     */
    protected $kernel;
    /**
     *
     * @var UploadService 
     */
    protected $upload;
    /**
     *
     * @var EntityManager 
     */
    protected $em;

    public function __construct(RequestStack $requestStack, AppKernel $kernel, UploadService $upload,  EntityManager $em)
    {
        $this->requestStack = $requestStack;
        $this->kernel = $kernel;
        $this->upload = $upload;
        $this->em = $em;
    }

    /**
     * @param  $profissional
     */
    public function salvarProfissional(\DesportoBundle\Entity\Profissional $profissional, Collection $arquivos)
    {
        $request = $this->requestStack->getCurrentRequest();
        
        $fotoExcluida   = $request->get("fotoExcluida", "");
        $pathTemp       = $this->kernel->getRootDir()."/../web/uploads/temp/";
        $path           = $this->kernel->getRootDir()."/../web/uploads/arquivos/";

        $this->salvarFoto($profissional, $fotoExcluida);
        
        foreach ($profissional->getArquivos() as $arquivo) {
            if (file_exists($pathTemp.$arquivo->getNome())) {
                $originalName = $arquivo->getNome();
                $arquivo->setNome($this->upload->getRealName($arquivo->getNome(), $path));
                rename($pathTemp.$originalName, $path.$arquivo->getNome());
            }
        }
        foreach ($arquivos as $arquivo) {
            if (!$profissional->getArquivos()->contains($arquivo)) {
                if (file_exists($path.$arquivo->getNome())) {
                    unlink($path.$arquivo->getNome());
                }
                $this->em->remove($arquivo);
            }
        }
        
        $this->em->persist($profissional);
        $this->em->flush();
    }
    
    
    
    private function salvarFoto(\DesportoBundle\Entity\Profissional $profissional, $fotoExcluida)
    {
        $pathTemp       = $this->kernel->getRootDir()."/../web/uploads/temp/";
        $path           = $this->kernel->getRootDir()."/../web/uploads/arquivos/";
        if (!empty($fotoExcluida) && $profissional->getId()>0 && file_exists($path.$fotoExcluida)) {
            unlink($path.$fotoExcluida);
        }

        if (file_exists($pathTemp.$profissional->getFoto())) {
            $originalNameFoto = $profissional->getFoto();
            $profissional->setFoto($this->upload->getRealName($profissional->getFoto(), $path));
            rename($pathTemp.$originalNameFoto, $path.$profissional->getFoto());
        }
    }
    
}
