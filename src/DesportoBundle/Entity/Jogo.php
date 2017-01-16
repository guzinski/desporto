<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Jogo
 * @ORM\Table(name="jogo")
 * @ORM\Entity
 */
class Jogo
{
    
    const PRIMEIRO_TEMPO = '1';
    const SEGUNDO_TEMPO = '2';

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;

    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_mandante", referencedColumnName="id")
     * })
     */
    private $equipeMandante;
    
    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_visitante", referencedColumnName="id")
     * })
     */
    private $equipeVisitante;
    
    /**
     * @var Rodada
     *
     * @ORM\ManyToOne(targetEntity="Rodada", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rodada", referencedColumnName="id")
     * })
     */
    private $rodada;
        
    /**
     * @var Chave
     *
     * @ORM\ManyToOne(targetEntity="Chave", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chave", referencedColumnName="id")
     * })
     */
    private $chave;
    
    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")
     * })
     */
    private $edicaoCampeonato;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $horario;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $local;
    
    
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $mesario;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $arbitro1;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $arbitro2;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $jogado = FALSE;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Gol", cascade={"all"}, mappedBy="jogo", orphanRemoval=true)
     **/
    private $gols;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Cartao", cascade={"all"}, mappedBy="jogo", orphanRemoval=true)
     **/
    private $cartoes;
        
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProfissionalJogo", cascade={"all"}, mappedBy="jogo")
     **/
    private $profissionalJogos;
    
    
    /**
     * @var Collection
     */
    private $golsMandante;
    
    /**
     * @var Collection
     */
    private $golsVisitante;
    
    private $numeroGolsMandante;
    private $numeroGolsVisitante;

    /**
     * @var Collection
     */    
    private $cartoesAmarelosMandante;
    
    /**
     * @var Collection
     */
    private $cartoesAmarelosVisitante;
    
    /**
     * @var Collection
     */
    private $cartoesVermelhosMandante;
    
    /**
     * @var Collection
     */
    private $cartoesVermelhosVisitante;
    
    
    private $numeroCartoesAmarelosMandante;
    private $numeroCartoesAmarelosVisitante;
    private $numeroCartoesVermelhosMandante;
    private $numeroCartoesVermelhosVisitante;

    public function __construct(Equipe $equipeMandante = null, Equipe $equipeVisitante = null)
    {
        $this->equipeMandante = $equipeMandante;
        $this->equipeVisitante = $equipeVisitante;
        $this->profissionalJogos = new ArrayCollection();
        $this->golsMandante = new ArrayCollection();
        $this->golsVisitante = new ArrayCollection();
        $this->cartoesAmarelosMandante = new ArrayCollection();
        $this->cartoesAmarelosVisitante = new ArrayCollection();
        $this->cartoesVermelhosMandante = new ArrayCollection();
        $this->cartoesVermelhosVisitante = new ArrayCollection();
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEquipeMandante()
    {
        return $this->equipeMandante;
    }

    public function getEquipeVisitante()
    {
        return $this->equipeVisitante;
    }

    public function getRodada()
    {
        return $this->rodada;
    }

    public function getChave()
    {
        return $this->chave;
    }

    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function getGols()
    {
        return $this->gols;
    }

    public function getCartoes()
    {
        return $this->cartoes;
    }

    public function setEquipeMandante(Equipe $equipeMandante)
    {
        $this->equipeMandante = $equipeMandante;
        return $this;
    }

    public function setEquipeVisitante(Equipe $equipeVisitante)
    {
        $this->equipeVisitante = $equipeVisitante;
        return $this;
    }

    public function setRodada(Rodada $rodada)
    {
        $this->rodada = $rodada;
        return $this;
    }

    public function setChave(Chave $chave)
    {
        $this->chave = $chave;
        return $this;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }

    public function setData(DateTime $data)
    {
        $this->data = $data;
        return $this;
    }

    public function setHorario(DateTime $horario)
    {
        $this->horario = $horario;
        return $this;
    }

    public function setLocal($local)
    {
        $this->local = $local;
        return $this;
    }

    public function setGols(Collection $gols)
    {
        $this->gols = $gols;
        return $this;
    }

    public function setCartoes(Collection $cartoes)
    {
        $this->cartoes = $cartoes;
        return $this;
    }
    
    public function getProfissionalJogos()
    {
        return $this->profissionalJogos;
    }

    public function setProfissionalJogos(Collection $profissionalJogos)
    {
        $this->profissionalJogos = $profissionalJogos;
        return $this;
    }
    
    public function getMesario()
    {
        return $this->mesario;
    }

    public function getArbitro1()
    {
        return $this->arbitro1;
    }

    public function getArbitro2()
    {
        return $this->arbitro2;
    }

    public function setMesario($mesario)
    {
        $this->mesario = $mesario;
        return $this;
    }

    public function setArbitro1($arbitro1)
    {
        $this->arbitro1 = $arbitro1;
        return $this;
    }

    public function setArbitro2($arbitro2)
    {
        $this->arbitro2 = $arbitro2;
        return $this;
    }
    
    public function getJogado()
    {
        return $this->jogado;
    }

    public function setJogado($jogado)
    {
        $this->jogado = $jogado;
        return $this;
    }

    
    
    public function addProfissionalJogo(ProfissionalJogo $profissionaljogo) 
    {
        $profissionaljogo->setJogo($this);
        $this->profissionalJogos->add($profissionaljogo);
    }
    
    public function removeProfissionalJogo(ProfissionalJogo $profissionaljogo)
    {
        
    }
    
    public function addGol(Gol $gol) 
    {
        $gol->setJogo($this);
        $this->gols->add($gol);
    }
    
    public function removeGol(Gol $gol)
    {
        if ($this->gols->contains($gol)) {
            
            $this->gols->removeElement($gol);
        }
    }

    
    public function addCartoe(Cartao $cartao) 
    {
        $cartao->setJogo($this);
        $this->cartoes->add($cartao);
    }
    
    public function removeCartoe(Cartao $cartao) 
    {
        if ($this->cartoes->contains($gol)) {
            
            $this->cartoes->removeElement($gol);
        }
    }
    
    public function getGolsMandante()
    {
        $this->golsMandante = new ArrayCollection();
        foreach ($this->getGols() as $gol) {
            /* @var $gol Gol  */
            if ($gol->getInscricao()->getEquipe() == $this->getEquipeMandante()) {
                $this->golsMandante->add($gol);
            }
        }
        return $this->golsMandante;
    }

    public function getGolsVisitante()
    {
        $this->golsVisitante = new ArrayCollection();
        foreach ($this->getGols() as $gol) {
            /* @var $gol Gol  */
            if ($gol->getInscricao()->getEquipe() == $this->getEquipeVisitante()) {
                $this->golsVisitante->add($gol);
            }
        }
        return $this->golsVisitante;
    }

    public function getNumeroGolsMandante()
    {
        $this->numeroGolsMandante = $this->getGolsMandante()->count();

        return $this->numeroGolsMandante;
    }

    public function getNumeroGolsVisitante()
    {
        $this->numeroGolsVisitante = $this->getGolsVisitante()->count();

        return $this->numeroGolsVisitante;
    }

    public function setGolsMandante(Collection $golsMandante)
    {
        $this->golsMandante = $golsMandante;
        return $this;
    }

    public function setGolsVisitante(Collection $golsVisitante)
    {
        $this->golsVisitante = $golsVisitante;
        return $this;
    }

    public function setNumeroGolsMandante($numeroGolsMandante)
    {
        $this->numeroGolsMandante = $numeroGolsMandante;
        return $this;
    }

    public function setNumeroGolsVisitante($numeroGolsVisitante)
    {
        $this->numeroGolsVisitante = $numeroGolsVisitante;
        return $this;
    }
    
    public function getCartoesAmarelosMandante()
    {
        $this->cartoesAmarelosMandante = new ArrayCollection();
        foreach ($this->getCartoes() as $cartao) {
            /* @var $cartao Cartao  */
            if ($cartao->getInscricao()->getEquipe() == $this->getEquipeMandante() && $cartao->getCor() == Cartao::AMARELO) {
                $this->cartoesAmarelosMandante->add($cartao);
            }
        }
        return $this->cartoesAmarelosMandante;
    }

    public function getNumeroCartoesAmarelosMandante()
    {
        $this->numeroCartoesAmarelosMandante = $this->getCartoesAmarelosMandante()->count();
        return $this->numeroCartoesAmarelosMandante;
    }
    
    public function getCartoesAmarelosVisitante()
    {
        $this->cartoesAmarelosVisitante = new ArrayCollection();
        foreach ($this->getCartoes() as $cartao) {
            /* @var $cartao Cartao  */
            if ($cartao->getInscricao()->getEquipe() == $this->getEquipeVisitante() && $cartao->getCor() == Cartao::AMARELO) {
                $this->cartoesAmarelosVisitante->add($cartao);
            }
        }
        return $this->cartoesAmarelosVisitante;
    }

    public function getNumeroCartoesAmarelosVisitante()
    {
        $this->numeroCartoesAmarelosVisitante = $this->getCartoesAmarelosVisitante()->count();
        return $this->numeroCartoesAmarelosVisitante;
    }
    
    public function getCartoesVermelhosMandante()
    {
        $this->cartoesVermelhosMandante = new ArrayCollection();
        foreach ($this->getCartoes() as $cartao) {
            /* @var $cartao Cartao  */
            if ($cartao->getInscricao()->getEquipe() == $this->getEquipeMandante() && $cartao->getCor() == Cartao::VERMELHO) {
                $this->cartoesVermelhosMandante->add($cartao);
            }
        }
        return $this->cartoesVermelhosMandante;
    }

    public function getNumeroCartoesVermelhosMandante()
    {
        $this->numeroCartoesVermelhosMandante = $this->getCartoesVermelhosMandante()->count();
        return $this->numeroCartoesVermelhosMandante;
    }
    
    public function getCartoesVermelhosVisitante()
    {
        $this->cartoesVermelhosVisitante = new ArrayCollection();
        foreach ($this->getCartoes() as $cartao) {
            /* @var $cartao Cartao  */
            if ($cartao->getInscricao()->getEquipe() == $this->getEquipeVisitante() && $cartao->getCor() == Cartao::VERMELHO) {
                $this->cartoesVermelhosVisitante->add($cartao);
            }
        }
        return $this->cartoesVermelhosVisitante;
    }

    public function getNumeroCartoesVermelhosVisitante()
    {
        $this->numeroCartoesVermelhosVisitante = $this->getCartoesVermelhosVisitante()->count();
        return $this->numeroCartoesVermelhosVisitante;
    }

    public function setCartoesVermelhosVisitante(Collection $cartoesVermelhosVisitante)
    {
        $this->cartoesVermelhosVisitante = $cartoesVermelhosVisitante;
        return $this;
    }

    public function setNumeroCartoesVermelhosVisitante($numeroCartoesVermelhosVisitante)
    {
        $this->numeroCartoesVermelhosVisitante = $numeroCartoesVermelhosVisitante;
        return $this;
    }

    
    public function setCartoesVermelhosMandante(Collection $cartoesVermelhosMandante)
    {
        $this->cartoesVermelhosMandante = $cartoesVermelhosMandante;
        return $this;
    }

    public function setNumeroCartoesVermelhosMandante($numeroCartoesVermelhosMandante)
    {
        $this->numeroCartoesVermelhosMandante = $numeroCartoesVermelhosMandante;
        return $this;
    }

    
    public function setCartoesAmarelosVisitante(Collection $cartoesAmarelosVisitante)
    {
        $this->cartoesAmarelosVisitante = $cartoesAmarelosVisitante;
        return $this;
    }

    public function setNumeroCartoesAmarelosVisitante($numeroCartoesAmarelosVisitante)
    {
        $this->numeroCartoesAmarelosVisitante = $numeroCartoesAmarelosVisitante;
        return $this;
    }

    
    public function setCartoesAmarelosMandante(Collection $cartoesAmarelosMandante)
    {
        $this->cartoesAmarelosMandante = $cartoesAmarelosMandante;
        return $this;
    }

    public function setNumeroCartoesAmarelosMandante($numeroCartoesAmarelosMandante)
    {
        $this->numeroCartoesAmarelosMandante = $numeroCartoesAmarelosMandante;
        return $this;
    }


}
