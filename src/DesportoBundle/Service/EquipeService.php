<?php

namespace DesportoBundle\Service;

use AppKernel;
use DesportoBundle\Data\Classificacao;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Repository\JogoRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use InvalidArgumentException;
use Proxies\__CG__\DesportoBundle\Entity\Jogo;
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
    
    /**
     * Retorna o histórico da equipe no campeonato
     * 
     * @param Equipe $equipe
     * @param EdicaoCampeonato $campeonato
     * @return Classificacao
     * @throws InvalidArgumentException
     */
    public function getHistoricoEquipeCampeonato(Equipe $equipe, EdicaoCampeonato $campeonato)
    {
        if (is_null($campeonato) || is_null($equipe)) {
            throw new InvalidArgumentException;
        }
        
        $classificacao = new Classificacao($equipe);
        
        $jogos = $this->getjogoRepository()->getjogosJogados($campeonato, null, null, $equipe);
        
        
        foreach ($jogos as $jogo) {
            /* @var $jogo Jogo  */
            
            if ($equipe==$jogo->getEquipeMandante()) {
                if ($jogo->getNumeroGolsMandante() > $jogo->getNumeroGolsVisitante()) {
                    $classificacao->addVitoria();
                } elseif ($jogo->getNumeroGolsMandante() === $jogo->getNumeroGolsVisitante()) {
                    $classificacao->addEmpate();
                } else {
                    $classificacao->addDerrota();
                }
                $classificacao->addCartaoAmarelo($jogo->getNumeroCartoesAmarelosMandante());
                $classificacao->addCartaoVermelho($jogo->getNumeroCartoesVermelhosMandante());
                $classificacao->addGolsMarcados($jogo->getNumeroGolsMandante());
                $classificacao->addGolsSofridos($jogo->getNumeroGolsVisitante());
            } elseif ($equipe==$jogo->getEquipeVisitante()) {
                if ($jogo->getNumeroGolsMandante() > $jogo->getNumeroGolsVisitante()) {
                    $classificacao->addDerrota();
                } elseif ($jogo->getNumeroGolsMandante() === $jogo->getNumeroGolsVisitante()) {
                    $classificacao->addEmpate();
                } else {
                    $classificacao->addVitoria();
                }
                $classificacao->addCartaoAmarelo($jogo->getNumeroCartoesAmarelosVisitante());
                $classificacao->addCartaoVermelho($jogo->getNumeroCartoesVermelhosVisitante());
                $classificacao->addGolsMarcados($jogo->getNumeroGolsVisitante());
                $classificacao->addGolsSofridos($jogo->getNumeroGolsMandante());
            }
        }
        
        return $classificacao;
    }

    /**
     * 
     * @return JogoRepository
     */
    private function getjogoRepository()
    {
        return $this->em->getRepository(Jogo::class);
    }

    
}
