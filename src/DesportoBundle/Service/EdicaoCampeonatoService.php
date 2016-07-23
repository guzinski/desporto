<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\Chave;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\FaseClassificatoria;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Entity\Rodada;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Exception;

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
        $campeonato->setRodadas(new ArrayCollection($this->gerarRodadas($campeonato->getEquipes())));
        if ($campeonato->getPontosCorridos() == "R") {
            $this->gerarReturno();
        }
        $this->salvar();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarTorneio(EdicaoCampeonato $campeonato)
    {
        $this->edicaoCampeonato = $campeonato;
        $this->gerarJogosTorneio();
        $this->salvar();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarChaves(EdicaoCampeonato $campeonato)
    {
        $this->edicaoCampeonato = $campeonato;
        foreach ($campeonato->getChaves() as $chave) {
            /* @var $chave Chave */
            $chave->setEdicaoCampeonato($campeonato);
            foreach ($chave->getEquipes() as $equipe) {
                $campeonato->getEquipes()->add($equipe);
            }
        }
        $campeonato->setRodadas(new ArrayCollection($this->gerarRodadasChaves($campeonato->getChaves())));
        if ($this->edicaoCampeonato->getFaseDeGrupos() == "R") {
            $this->gerarReturno();
        }
        $this->salvar();
        
    }
    
    /**
     * Persiste o Campeonato
     */
    private function salvar()
    {
        $this->em->persist($this->edicaoCampeonato);
        $this->em->flush();
    }

    /**
     * Gera os primerios jogos do torneio
     */
    private function gerarJogosTorneio()
    {
        foreach ($this->edicaoCampeonato->getFasesClassificatorias() as $fase) {
            /* @var $fase FaseClassificatoria */
            $equipes = $fase->getEquipes()->toArray();
            
            $jogo = new Jogo($equipes[0], $equipes[1]);
            $jogo->setEdicaoCampeonato($this->edicaoCampeonato);
            $fase->setPrimeiroJogo($jogo);
            if (
                ($fase->getTipo() == FaseClassificatoria::OITAVAS && $this->edicaoCampeonato->getOitavas()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::QUARTAS && $this->edicaoCampeonato->getQuartas()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::SEMIFINAL && $this->edicaoCampeonato->getSemiFinal()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::FINAL_ && $this->edicaoCampeonato->getFinal()=="I") 
                ) {
                $segundoJogo = new Jogo($jogo->getEquipeVisitante(), $jogo->getEquipeMandante());
                $segundoJogo->setEdicaoCampeonato($this->edicaoCampeonato);
                $fase->setPrimeiroJogo($segundoJogo);
            }
        }
    }
    
    /**
     * Gera o returno a partir das roas existentes no campeonato
     */
    private function gerarReturno()
    {
        $rodadas = $this->edicaoCampeonato->getRodadas()->toArray();
        $numeroRodada = $this->edicaoCampeonato->getRodadas()->count();
        
        foreach ($rodadas as $rodada) {
            /* @var $rodada Rodada */
            $rodadaAlternada = new Rodada($this->edicaoCampeonato, $numeroRodada++);
            
            foreach ($rodada->getJogos() as $jogo) {
                /* @var $jogo Jogo */
                //Inverte o mandante do jogo
                $jogoReturno = new Jogo($jogo->getEquipeVisitante(), $jogo->getEquipeMandante());

                if ($jogo->getChave() != null) {
                    $jogoReturno->setChave($jogo->getChave());
                }

                $jogoReturno->setRodada($rodadaAlternada)
                        ->setEdicaoCampeonato($this->edicaoCampeonato);
                $rodadaAlternada->getJogos()->add($jogoReturno);
            }
            
            $this->edicaoCampeonato->getRodadas()->add($rodadaAlternada);
        }
    }

    /**
     * Gera as Rodadas Da Chave
     * 
     * @param Collection $chaves
     * @return array
     */
    private function gerarRodadasChaves(Collection $chaves) 
    {
        $rodadas = array();
        $array = array();
        
        foreach ($chaves as $chave) {
            /* @var $chave Chave */
            $equipes = $chave->getEquipes()->toArray();
            shuffle($equipes);
            $array[] = $equipes;
        }
        
        for ($i=1; $i<count($array[0]); $i++) {
            $rodada = new Rodada($this->edicaoCampeonato, $i);
            
            for ($j=0; $j<$chaves->count(); $j++) {
                
                $arrayEquipes = $array[$j];
                $count = 1;
                while (count($arrayEquipes)>1) {

                    $primeiro = $arrayEquipes[0];
                    $ultimo = end($arrayEquipes);

                    //Inverte os mandos
                    if (($count == 1 && $i%2 == 0) || ($count%2 == 0)) {
                        $jogo = new Jogo($ultimo, $primeiro);
                    } else {
                        $jogo = new Jogo($primeiro, $ultimo);
                    }

                    $jogo->setChave($chaves->get($j));
                    $chaves->get($j)->getJogos()->add($jogo);

                    $jogo->setRodada($rodada)
                            ->setEdicaoCampeonato($this->edicaoCampeonato);
                    $rodada->getJogos()->add($jogo);

                    array_splice($arrayEquipes, array_search($primeiro, $arrayEquipes), 1);
                    array_splice($arrayEquipes, array_search($ultimo, $arrayEquipes), 1);

                    $count++;
                }
            }
            $novoArray = array();
            foreach ($array as $value) {
               $novoArray[] = $this->girarArray($value);
            }
            $array = $novoArray;
            $rodadas[] = $rodada;
        }
        
        return $rodadas;        
    }

    
    /**
     * 
     * @param Collection $equipes
     * @return array
     */
    private function gerarRodadas(Collection $equipes)
    {
        $rodadas = array();
        
        $array = $equipes->toArray();
        //Embaralha as euipes
        shuffle($array);
        
        for ($i=1; $i<$equipes->count(); $i++) {
            $rodada = new Rodada($this->edicaoCampeonato, $i);
            
            $arrayEquipes = $array;
            $count = 1;
            while (count($arrayEquipes)>1) {
                
                $primeiro = $arrayEquipes[0];
                $ultimo = end($arrayEquipes);

                //Inverte os mandos
                if (($count == 1 && $i%2 == 0) || ($count%2 == 0)) {
                    $jogo = new Jogo($ultimo, $primeiro);
                } else {
                    $jogo = new Jogo($primeiro, $ultimo);
                }
                
                $jogo->setRodada($rodada)
                        ->setEdicaoCampeonato($this->edicaoCampeonato);
                $rodada->getJogos()->add($jogo);
                
                array_splice($arrayEquipes, array_search($primeiro, $arrayEquipes), 1);
                array_splice($arrayEquipes, array_search($ultimo, $arrayEquipes), 1);
                
                $count++;
            }

            $array = $this->girarArray($array);
            $rodadas[] = $rodada;
        }
        
        return $rodadas;
    }
    
    
    /**
     * 
     * @param array $lista
     * @return array
     * @throws Exception
     */
    public function girarArray($lista)
    {
        if (!is_array($lista)) {
            throw new Exception("Um array deve ser passado para  o método: girarArrya()");
        }
        if (empty($lista)) {
            return $lista;
        }
        $novaLista = array();
        $primeiro = $lista[0];
        $ultimo = end($lista);
        
        array_splice($lista, array_search($primeiro, $lista), 1);
        array_splice($lista, array_search($ultimo, $lista), 1);
        
        $novaLista[] = $primeiro;
        $novaLista[] = $ultimo;
        foreach ($lista as $item) {
            $novaLista[] = $item;
        }
        
        return $novaLista;;
    }

    
//    /**
//     * @deprecated since version number
//     * 
//     * @param Equipe $equipeMandante
//     * @param Equipe $equipeVisitante
//     * @param array $rodadas
//     * @return boolean
//     */
//    private function verificaJogoExistente (Equipe $equipeMandante, Equipe $equipeVisitante, $rodadas)
//    {
//        foreach ($rodadas as $rodada) {
//            /* @var $rodada Rodada */
//            foreach ($rodada->getJogos() as $jogo) {
//                /* @var $jogo Jogo */
//                if ($jogo->getEquipeMandante()===$equipeMandante || $jogo->getEquipeVisitante()===$equipeMandante) {
//                    if ($jogo->getEquipeMandante()===$equipeVisitante || $jogo->getEquipeVisitante()===$equipeVisitante) {
//                        return true;
//                    }
//                }
//            }
//        }
//        return false;
//    }
//    
//    
//    /**
//     * @deprecated since version number
//     * 
//     * @param Equipe $equipeMandante
//     * @param Equipe $equipeVisitante
//     * @param Rodada $rodada
//     * @return boolean
//     */
//    private function verificaEquipeJogaRodada (Equipe $equipeMandante, Equipe $equipeVisitante, Rodada $rodada)
//    {
//        foreach ($rodada->getJogos() as $jogo) {
//            /* @var $jogo Jogo */
//            if ($jogo->getEquipeMandante()===$equipeMandante || $jogo->getEquipeVisitante()===$equipeMandante) {
//                return true;
//            }
//            if ($jogo->getEquipeMandante()===$equipeVisitante || $jogo->getEquipeVisitante()===$equipeVisitante) {
//                return true;
//            }
//        }
//        return false;
//    }
    
}