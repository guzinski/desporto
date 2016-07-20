<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\Chave;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Entity\Rodada;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

/**
 * Description of EdicaoCampeonatoService
 *
 */
class EdicaoCampeonatoService
{

    /**
     * @var EntityManager 
     */
    protected $em;
    
    
    /**
     * @var EdicaoCampeonato 
     */
    protected $edicaoCampeonato;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarPontosCorridos(EdicaoCampeonato $campeonato)
    {
        $this->edicaoCampeonato = $campeonato;
        $rodadas = $this->gerarRodadas($campeonato->getEquipes());
        $campeonato->setRodadas(new ArrayCollection($rodadas));
        $this->em->persist($campeonato);
        $this->em->flush();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarTorneio(EdicaoCampeonato $campeonato)
    {
        var_dump($campeonato);
        die();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarChaves(EdicaoCampeonato $campeonato)
    {
        $this->edicaoCampeonato = $campeonato;
        foreach ($campeonato->getChaves() as $chave) {
            /* @var $chave Chave */
            $rodadss = $this->gerarRodadas($chave->getEquipes());
            foreach ($rodadss as $rodada) {
                $campeonato->getRodadas()->add($rodada);
            }
        }
        $this->em->persist($campeonato);
        $this->em->flush();
    }
    
    
    /**
     * 
     * @param Collection $equipes
     * @return array
     */
    private function gerarRodadas(Collection $equipes)
    {
        $rodadas = array();
        
        for ($i=1; $i<$equipes->count(); $i++) {
            $rodada = new Rodada($this->edicaoCampeonato, $i);
            
            $arrayEquipes = $equipes->toArray();

            shuffle($arrayEquipes);
            
            while ($rodada->getJogos()->count() < ($equipes->count()/2) ) {
                $sortMandante = rand(0, count($arrayEquipes) - 1);
                $equipeMandante = $arrayEquipes[$sortMandante];
                array_splice($arrayEquipes, $sortMandante, 1);
                
                foreach ($arrayEquipes as $equipeVisitante) {
                    if (!$this->verificaJogoExistente($equipeMandante, $equipeVisitante, $rodadas)) {
                        $jogo = new Jogo($equipeMandante, $equipeVisitante);
                        $jogo->setRodada($rodada)
                                ->setEdicaoCampeonato($this->edicaoCampeonato);
                        $rodada->getJogos()->add($jogo);
                        array_splice($arrayEquipes, array_search($equipeVisitante, $arrayEquipes), 1);
                        break;
                    }
                }
                
//                $sortVisitante = rand(0, count($arrayEquipes) - 1);
//                $equipeVisitante = $arrayEquipes[$sortVisitante];
//                array_splice($arrayEquipes, $sortVisitante,1 );
//                
                
                
            }
            $rodadas[] = $rodada;
        }
        
        return $rodadas;
    }

    /**
     * 
     * @param Equipe $equipeMandante
     * @param Equipe $equipeVisitante
     * @param array $rodadas
     * @return boolean
     */
    private function verificaJogoExistente (Equipe $equipeMandante, Equipe $equipeVisitante, $rodadas)
    {
        foreach ($rodadas as $rodada) {
            /* @var $rodada Rodada */
            foreach ($rodada->getJogos() as $jogo) {
                /* @var $jogo Jogo */
                if ($jogo->getEquipeMandante()===$equipeMandante || $jogo->getEquipeVisitante()===$equipeMandante) {
                    if ($jogo->getEquipeMandante()===$equipeVisitante || $jogo->getEquipeVisitante()===$equipeVisitante) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    
}