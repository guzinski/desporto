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
            $chave->setEdicaoCampeonato($campeonato);
            foreach ($chave->getEquipes() as $equipe) {
                $campeonato->getEquipes()->add($equipe);
            }
        }
        $campeonato->setRodadas(new ArrayCollection($this->gerarRodadasChaves($campeonato->getChaves())));
        $this->em->persist($campeonato);
        $this->em->flush();
        
    }
    
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
     * @deprecated since version number
     * 
     * @param Equipe $equipeMandante
     * @param Equipe $equipeVisitante
     * @param type $rodadas
     * @return Rodada
     */
    private function inseriJogoRodadas (Equipe $equipeMandante, Equipe $equipeVisitante, $rodadas) 
    {
        $rodadaExiste = FALSE;
        foreach ($rodadas as $rodada) {
            if (!$this->verificaEquipeJogaRodada($equipeMandante, $equipeVisitante, $rodada)) {
                $jogo = new Jogo($equipeMandante, $equipeVisitante);
                $jogo->setRodada($rodada)
                        ->setEdicaoCampeonato($this->edicaoCampeonato);
                $rodada->getJogos()->add($jogo);
                $rodadaExiste = TRUE;
                break;
            }
        }
                
        if(!$rodadaExiste) {
            $rodada = new Rodada($this->edicaoCampeonato, count($rodadas)+1);
            $jogo = new Jogo($equipeMandante, $equipeVisitante);
            $jogo->setRodada($rodada)
                    ->setEdicaoCampeonato($this->edicaoCampeonato);
            $rodada->getJogos()->add($jogo);
            $rodadas[] = $rodada;
        }
        return $rodadas;
    }

    /**
     * @deprecated since version number
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
    
    private function verificaEquipeJogaRodada (Equipe $equipeMandante, Equipe $equipeVisitante, Rodada $rodada)
    {
        foreach ($rodada->getJogos() as $jogo) {
            /* @var $jogo Jogo */
            if ($jogo->getEquipeMandante()===$equipeMandante || $jogo->getEquipeVisitante()===$equipeMandante) {
                return true;
            }
            if ($jogo->getEquipeMandante()===$equipeVisitante || $jogo->getEquipeVisitante()===$equipeVisitante) {
                return true;
            }
        }
        return false;
    }
    
}