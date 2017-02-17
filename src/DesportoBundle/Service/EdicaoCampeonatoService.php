<?php

namespace DesportoBundle\Service;

use DesportoBundle\Data\Classificacao;
use DesportoBundle\Entity\Chave;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\FaseClassificatoria;
use DesportoBundle\Entity\Gol;
use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Entity\Profissional;
use DesportoBundle\Entity\Rodada;
use DesportoBundle\Repository\EdicaoCampeonatoRepository;
use DesportoBundle\Repository\EquipeRepository;
use DesportoBundle\Repository\GolRepository;
use DesportoBundle\Repository\JogoRepository;
use DesportoBundle\Repository\ProfissionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;
use Exception;
use InvalidArgumentException;
use Proxies\__CG__\DesportoBundle\Entity\Campeonato;

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
     * 
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarCampeonato(EdicaoCampeonato $campeonato)
    {
        if ($campeonato->getTipo()==EdicaoCampeonato::CHAVE) {
            $this->salvarChaves($campeonato);
        } elseif ($campeonato->getTipo()==EdicaoCampeonato::PONTOS_CORRIDOS) {
            $this->salvarPontosCorridos($campeonato);
        } elseif ($campeonato->getTipo()==EdicaoCampeonato::TORNEIO) {
            $this->salvarTorneio($campeonato);
        }
    }

    /**
     * Calcula partir do núemro de equipes, retorna as opç~eos de chaves que o cmapeonato pode ter
     * Ex: Se tiver 16 equipes, Retorna  um array [1, 2, 4]
     * 
     * @param int $numeroEquipes
     * @return array
     * @throws InvalidArgumentException
     */
    public function getQuantidadesPossiveisChaves($numeroEquipes)
    {
        if (is_null($numeroEquipes)) {
            throw new \InvalidArgumentException;
        }

        $result = [];
        
        for ($i=1; $i<$numeroEquipes/2; $i++) {
            if (log($i, 2)-(int)log($i, 2) == 0 && $numeroEquipes%$i == 0) {
                $result[] = $i;
            }
        }
        
        return $result;
    }
    
    /**
     * Calcula e retorna todas as possibilidades de quantidade de equipes classificadas por chave
     * Sendo que o mínimo de equipes classificadas no total deve ser 2 e o máximo equipes classificadas no total deve ser 16
     * Sendo sempre que total de equipes classificadas deve ser um núemro protência de 2 Ex: 2, 4, 8, 16
     * 
     * @param int $numeroEquipes
     * @param int $numeroChaves
     * @return array
     * @throws InvalidArgumentException
     */
    public function getQuantidadePossiveisClassificados($numeroEquipes, $numeroChaves)
    {
        if (empty($numeroChaves) || empty($numeroEquipes)) {
            throw new \InvalidArgumentException;
        }
        $numEquipesChave = $numeroEquipes/$numeroChaves;
        
        $result = [];
        
        for ($i=1; $i<$numEquipesChave; $i++) {
            if ($i*$numeroChaves==1) {
                continue;
            }
            if ($i*$numeroChaves>16) {
                break;
            }
            if (log($i*$numeroChaves, 2)-(int)log($i*$numeroChaves, 2) == 0 ) {
                $result[] = $i;
            }
        }

        return $result;
    }
  
    /** 
     * Retorna o tipo do campeonato a partir do núemro de equipes
     * 
     * @param int $numeroEquipes
     * @return array Retor4na um arrya com o label do campeoanto o e tipo
     * @throws InvalidArgumentException
     */
    public function getTipoTorneioByNumeroEquipes($numeroEquipes)
    {
        if (is_null($numeroEquipes) || (log($numeroEquipes, 2)-(int)log($numeroEquipes, 2) != 0)) {
            throw new InvalidArgumentException;
        }
        
        if ($numeroEquipes == 2) {
            $result = [
              "label" =>  "Final",
              "tipo" => FaseClassificatoria::FINAL_,
            ];
        } elseif ($numeroEquipes == 4) {
            $result = [
              "label" =>  "Semifinal",
              "tipo" => FaseClassificatoria::SEMIFINALL,
            ];
        } elseif ($numeroEquipes == 8) {
            $result = [
              "label" =>  "Quartas de Final",
              "tipo" => FaseClassificatoria::QUARTAS,
            ];
        } elseif ($numeroEquipes == 16) {
            $result = [
              "label" =>  "Oitavas de Final",
              "tipo" => FaseClassificatoria::OITAVAS,
            ];
        } else {
            throw new \InvalidArgumentException;
        }
        
        return $result;
    }
    
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    private function salvarPontosCorridos(EdicaoCampeonato $campeonato)
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
    private function salvarTorneio(EdicaoCampeonato $campeonato)
    {
        $this->edicaoCampeonato = $campeonato;
        $this->gerarJogosTorneio();
        $this->salvar();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    private function salvarChaves(EdicaoCampeonato $campeonato)
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
            $this->edicaoCampeonato->getEquipes()->add($equipes[0]);
            $this->edicaoCampeonato->getEquipes()->add($equipes[1]);
            $jogo = new Jogo($equipes[0], $equipes[1]);
            $jogo->setEdicaoCampeonato($this->edicaoCampeonato);
            $fase->setPrimeiroJogo($jogo);
            $fase->setEdicaoCampeonato($this->edicaoCampeonato);
            if (
                ($fase->getTipo() == FaseClassificatoria::OITAVAS && $this->edicaoCampeonato->getOitavas()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::QUARTAS && $this->edicaoCampeonato->getQuartas()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::SEMIFINAL && $this->edicaoCampeonato->getSemiFinal()=="I") ||
                ($fase->getTipo() == FaseClassificatoria::FINAL_ && $this->edicaoCampeonato->getFinal()=="I") 
                ) {
                $segundoJogo = new Jogo($jogo->getEquipeVisitante(), $jogo->getEquipeMandante());
                $segundoJogo->setEdicaoCampeonato($this->edicaoCampeonato);
                $fase->setSegundoJogo($segundoJogo);
            }
        }
    }
    
    /**
     * Gera o returno a partir das roas existentes no campeonato
     */
    private function gerarReturno()
    {
        $rodadas = $this->edicaoCampeonato->getRodadas()->toArray();
        $numeroRodada = $this->edicaoCampeonato->getRodadas()->count()+1;
        
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
    
    /**
     * 
     * @param Campeonato $campeonato
     * @param int $equipe
     * @param array $inscritos
     */
    public function inscreverJogadores(EdicaoCampeonato $campeonato, $idEquipe, $inscritos)
    {
        if (empty($campeonato) || empty($idEquipe) || empty($inscritos)) {
            throw new InvalidArgumentException;
        }

        $equipe = $this->getEquipeRepository()->find($idEquipe);
        foreach ($inscritos as $inscrito) {
            $jogador = $this->getProfissionaleRepository()->find($inscrito);
            $inscricao = new InscricaoProfissional($campeonato, $equipe, $jogador, InscricaoProfissional::JOGADOR);
            $this->em->persist($inscricao);
        }
        $this->em->flush();
    }
    
    /**
     * 
     * @param Campeonato $campeonato
     * @param int $equipe
     * @param array $inscritos
     */
    public function inscreverProfissional(EdicaoCampeonato $campeonato, $idEquipe, $profissional, $tipo)
    {
        if (is_null($campeonato) || empty($idEquipe) || empty($profissional) || empty($tipo)) {
            throw new InvalidArgumentException;
        }
        
        $retorno = [];
        
        $equipe = $this->getEquipeRepository()->find($idEquipe);
        $profissional = $this->getProfissionaleRepository()->find($profissional);
        
        $inscricao = new InscricaoProfissional($campeonato, $equipe, $profissional, $tipo);
        
        $this->em->persist($inscricao);
        
        $this->em->flush();

        return ["idEquipe" => $equipe->getId(), "profissional" => $profissional->getNome()];
    }

    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return EquipeRepository
     */
    public function verificafinalizacaoInscricao(EdicaoCampeonato $campeonato)
    {
        foreach ($campeonato->getEquipes() as $equipe) {
            /* @var $equipe Equipe */
            if (!$equipe->getDiretor($campeonato)) {
                return FALSE;
            }
            if (!$equipe->getTreinador($campeonato)) {
                return FALSE;
            }
            if ($campeonato->getQuantidadeMinimaJogadores() > $equipe->getJogadores($campeonato)->count()) {
                return FALSE;
            }
        }
        
        $campeonato->setStatus(EdicaoCampeonato::EM_ANDAMENTO);
        
        $this->em->persist($campeonato);
        $this->em->flush();
        
        return TRUE;
    }
    
    /**
     * 
     * @return EquipeRepository
     */
    private function getEquipeRepository()
    {
        return $this->em->getRepository(Equipe::class);
    }
    
    /**
     * 
     * @return ProfissionalRepository
     */
    private function getProfissionaleRepository()
    {
        return $this->em->getRepository(Profissional::class);
    }
    
    /**
     * 
     * @return EdicaoCampeonatoRepository
     */
    private function getEdicaoCampeonatoRepository()
    {
        return $this->em->getRepository(EdicaoCampeonato::class);
    }

    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return mixed
     */
    public function calculaArtilharia(EdicaoCampeonato $campeonato)
    {
        $gols = $this->getGolRepository()->getGolsFromCampeonato($campeonato);
        $artilharia = [];
        foreach ($gols as $gol) {
            /* @var $gol Gol  */
            if (!array_key_exists($gol->getInscricao()->getId(), $artilharia)){
                $artilharia[$gol->getInscricao()->getId()] = ['inscricao'=> $gol->getInscricao(), 'gols' => 1];
            } else {
                $artilharia[$gol->getInscricao()->getId()]['gols']++;
            }
        }
        


        uksort($artilharia, function ($a, $b) use($artilharia) {
            if ($artilharia[$a]['gols'] < $artilharia[$b]['gols']) {
                return 1;
            } elseif ($artilharia[$a]['gols'] > $artilharia[$b]['gols']) {
                return -1;
            }
        });


        return $artilharia;
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return mixed
     */
    public function calculaTabela(EdicaoCampeonato $campeonato)
    {
        if ($campeonato->getTipo() == EdicaoCampeonato::PONTOS_CORRIDOS) {
            return $this->calculaTabelaPontosCorridos($campeonato);
        }
        if ($campeonato->getTipo() == EdicaoCampeonato::CHAVE) {
            return $this->calculaTabelaChave($campeonato);
        }
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return array
     */
    public function calculaTabelaChave(EdicaoCampeonato $campeonato)
    {
        $tabelas = [];
        
        foreach ($campeonato->getChaves() as $chave) {
            /* @var $chave Chave */
            $tabelaChave = new ArrayCollection();

            $jogos = $this->getjogoRepository()->getjogosJogados($campeonato, $chave);

            foreach ($chave->getEquipes() as $equipe) {
                $this->getClassificacaoEquipe($equipe, $tabelaChave);
            }

            $this->montaTabela($jogos, $tabelaChave);                
                    
            $tabelas[] = $this->ordenaTabela($tabelaChave, $campeonato);

        }
        
        return $tabelas;

    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return ArrayCollection
     */
    private function calculaTabelaPontosCorridos(EdicaoCampeonato $campeonato)
    {
        $tabela = new ArrayCollection();
        
        $jogos = $this->getjogoRepository()->getjogosJogados($campeonato);
        
        
        foreach ($campeonato->getEquipes() as $equipe) {
            $this->getClassificacaoEquipe($equipe, $tabela);
        }
        
        $this->montaTabela($jogos, $tabela);                
        
        return $this->ordenaTabela($tabela, $campeonato);
        
    }
    
    private function ordenaTabela(Collection $tabela, EdicaoCampeonato $campeonato)
    {
        $iterator = $tabela->getIterator();
        $iterator->uasort(function (Classificacao $first, Classificacao $second) use ($campeonato) {
            return $this->regraOrdenacao($first, $second, $campeonato, 1);
        });
        
        return new ArrayCollection(iterator_to_array($iterator));
    }
    
    
    private function montaTabela($jogos, $tabela)
    {
        foreach ($jogos as $jogo) {
            /* @var $jogo Jogo */
            $classificacaoMandante = $this->getClassificacaoEquipe($jogo->getEquipeMandante(), $tabela);
            $classificacaoVisitante = $this->getClassificacaoEquipe($jogo->getEquipeVisitante(), $tabela);


            if ($jogo->getNumeroGolsMandante() > $jogo->getNumeroGolsVisitante()) {
                $classificacaoMandante->addVitoria();
                $classificacaoVisitante->addDerrota();
            } elseif ($jogo->getNumeroGolsMandante() === $jogo->getNumeroGolsVisitante()) {
                $classificacaoMandante->addEmpate();
                $classificacaoVisitante->addEmpate();
            } else {
                $classificacaoMandante->addDerrota();
                $classificacaoVisitante->addVitoria();
            }
            $classificacaoMandante->addCartaoAmarelo($jogo->getNumeroCartoesAmarelosMandante());
            $classificacaoMandante->addCartaoVermelho($jogo->getNumeroCartoesVermelhosMandante());
            $classificacaoMandante->addGolsMarcados($jogo->getNumeroGolsMandante());
            $classificacaoMandante->addGolsSofridos($jogo->getNumeroGolsVisitante());

            $classificacaoVisitante->addCartaoAmarelo($jogo->getNumeroCartoesAmarelosVisitante());
            $classificacaoVisitante->addCartaoVermelho($jogo->getNumeroCartoesVermelhosVisitante());
            $classificacaoVisitante->addGolsMarcados($jogo->getNumeroGolsVisitante());
            $classificacaoVisitante->addGolsSofridos($jogo->getNumeroGolsMandante());
        }
    }
    
    private function regraOrdenacao(Classificacao $first, Classificacao $second, EdicaoCampeonato $campeonato, $nivel)
    {
        if ($first->getPontos() > $second->getPontos()) {
            return -1;
        }
        if ($first->getPontos() < $second->getPontos()) {
            return 1;
        }
        
        if ($nivel == 1) {
            $desempate = $campeonato->getDesempate1();
        } elseif ($nivel == 2) {
            $desempate = $campeonato->getDesempate2();
        } elseif ($nivel == 3) {
            $desempate = $campeonato->getDesempate3();
        } else {
            return 0;
        }
        
        if ($desempate == EdicaoCampeonato::DISCIPLINA) {
            if ($first->getCartoesVermelhos() > $second->getCartoesVermelhos()) {
                return 1;
            } elseif ($first->getCartoesVermelhos() < $second->getCartoesVermelhos()) {
                return -1;
            } elseif ($first->getCartoesAmarelos() > $second->getCartoesAmarelos()) {
                return 1;
            } elseif ($first->getCartoesAmarelos() < $second->getCartoesAmarelos()) {
                return -1;
            } else {
                return $this->regraOrdenacao($first, $second, $campeonato, ++$nivel);
            }
        } elseif ($desempate == EdicaoCampeonato::VITORIA) {
            if ($first->getVitorias() > $second->getVitorias()) {
                return -1;
            } elseif ($first->getVitorias() < $second->getVitorias()) {
                return 1;
            } else {
                return $this->regraOrdenacao($first, $second, $campeonato, ++$nivel);
            }
        } elseif ($desempate == EdicaoCampeonato::SALDO_GOLS) {
            if ($first->getGolsSaldo() > $second->getGolsSaldo()) {
                return -1;
            } elseif ($first->getGolsSaldo() < $second->getGolsSaldo()) {
                return 1;
            } elseif ($first->getGolsMarcados() > $second->getGolsMarcados()) {
                return -1;
            } elseif ($first->getGolsMarcados() < $second->getGolsMarcados()) {
                return 1;
            } else {
                return $this->regraOrdenacao($first, $second, $campeonato, ++$nivel);
            }
        }

    }
    
    /**
     * 
     * @param Equipe $equipe
     * @param Collection $tabela
     * @return Classificacao
     */
    private function getClassificacaoEquipe(Equipe $equipe, Collection $tabela)
    {
        foreach ($tabela as $classificacao) {
            /* @var $classificacao Classificacao */
            if ($classificacao->getEquipe()==$equipe) {
                return $classificacao;
            }
        }
        $classificacao = new Classificacao($equipe);
        $tabela->add($classificacao);
        return $classificacao;
    }
    
    
    /**
     * 
     * @return JogoRepository
     */
    public function getjogoRepository()
    {
        return $this->em->getRepository(Jogo::class);
    }
    
    /**
     * 
     * @return GolRepository
     */
    public function getGolRepository()
    {
        return $this->em->getRepository(Gol::class);
    }
}