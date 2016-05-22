<?php

namespace DesportoBundle\Service;

use AppKernel;
use DesportoBundle\Entity\Equipe;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\HttpFoundation\RequestStack;

/**
 * Description of Equipe
 *
 * @author Luciano
 */
class EquipeService
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
     * @var Upload 
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
     * @param  $equipe
     */
    public function salvarEquipe(Equipe $equipe, Collection $arquivos)
    {
        $request = $this->requestStack->getCurrentRequest();
        
        $brasaoExcluido = $request->get("brasaoExcluido", "");
        $pathTemp       = $this->kernel->getRootDir()."/../web/uploads/temp/";
        $path           = $this->kernel->getRootDir()."/../web/uploads/arquivos/";

        $this->salvarBrasao($equipe, $brasaoExcluido);
        
        foreach ($equipe->getArquivos() as $arquivo) {
            if (file_exists($pathTemp.$arquivo->getNome())) {
                $originalName = $arquivo->getNome();
                $arquivo->setNome($this->upload->getRealName($arquivo->getNome(), $path));
                rename($pathTemp.$originalName, $path.$arquivo->getNome());
            }
        }
        foreach ($arquivos as $arquivo) {
            if (!$equipe->getArquivos()->contains($arquivo)) {
                if (file_exists($path.$arquivo->getNome())) {
                    unlink($path.$arquivo->getNome());
                }
                $this->em->remove($arquivo);
            }
        }
        
        $this->em->persist($equipe);
        $this->em->flush();
    }
    
    
    
    private function salvarBrasao(Equipe $equipe, $brasaoExcluido)
    {
        $pathTemp       = $this->kernel->getRootDir()."/../web/uploads/temp/";
        $path           = $this->kernel->getRootDir()."/../web/uploads/arquivos/";
        if (!empty($brasaoExcluido) && $equipe->getId()>0 && file_exists($path.$brasaoExcluido)) {
            unlink($path.$brasaoExcluido);
        }

        if (file_exists($pathTemp.$equipe->getBrasao())) {
            $originalNameBrasao = $equipe->getBrasao();
            $equipe->setBrasao($this->upload->getRealName($equipe->getBrasao(), $path));
            rename($pathTemp.$originalNameBrasao, $path.$equipe->getBrasao());
        }
    }
    
    
}
