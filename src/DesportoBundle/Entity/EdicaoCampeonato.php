<?php

namespace DesportoBundle\Entity;

use DesportoBundle\Doctrine\Type\EnumSexoType;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Exception\InvalidArgumentException;


/**
 * Description of EdicaoCampeonato
 * @ORM\Table(name="edicao_campeonato")
 * @ORM\Entity
 * @author Luciano
 */
class EdicaoCampeonato extends BaseEntity
{
    
    const TORNEIO = "T";
    const CHAVE = "C";
    const PONTOS_CORRIDOS = "p";
    
    
    const VITORIA = "V";
    const SALDO_GOLS = "S";
    const DISCIPLINA = "D";
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $edicao;    
    
    /**
     * @var Campeonato
     *
     * @ORM\ManyToOne(targetEntity="Campeonato", inversedBy="edicoesCampeonato")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato", referencedColumnName="id")
     * })
     */
    private $campeonato;

    /**
     *  @ORM\Column(type="sexotype", nullable=false)
     */
    private $modalidade;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('T', 'C', 'p')", nullable=false)
     */
    private $tipo;

    
    /**
     * @var int
     * 
     * número de equipes inscritas
     * @ORM\Column(name="quantidade_equipes", type="integer", nullable=false)
     */
    private $quantidadeEquipes;
    
    /**
     * @var int
     * 
     * quantidade mínima de jogadores por equipe
     * @ORM\Column(name="quantidade_minima_jogadores", type="integer", nullable=false)
     */
    private $quantidadeMinimaJogadores;
    
    /**
     * @var int
     * 
     * quantidade máxima de jogadores por equipe
     * @ORM\Column(name="quantidade_maxima_jogadores", type="integer", nullable=false)
     */
    private $quantidadeMaximaJogadores;
    
    /**
     * número de chaves do campeonato
     * @var int
     * 
     * @ORM\Column(name="quantidade_chaves", type="integer", nullable=false)
     */
    private $quantidadeChaves;
    
    /**
     * número de equipes classificadas por chave
     * @var int
     *
     * @ORM\Column(name="quantidade_classificados_chaves", type="integer", nullable=true)
     */
    private $quantidadeClassificadosChave;


    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate1;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate2;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate3;
    
    /**
     * @ORM\ManyToMany(targetEntity="Equipe", inversedBy="edicoesCampeonatos")
     * @ORM\JoinTable(name="edicao_campeonato_equipe",
     *      joinColumns={@ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id", unique=true)}
     * )
     */
    private $equipes;

    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="equipesCadastradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioCadastro;
    
    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="equipesExcluidas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioExclusao;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Chave", mappedBy="edicaoCampeonato")
     **/
    private $chaves;
    
    
    private $faseDeGrupos;
    private $oitavas;
    private $quartas;
    private $semiFinal;
    private $final;

    
    public function __construct()
    {
        $this->chaves = new ArrayCollection();
    }


    public function getEdicao()
    {
        return $this->edicao;
    }

    public function getCampeonato()
    {
        return $this->campeonato;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getQuantidadeEquipes()
    {
        return $this->quantidadeEquipes;
    }

    public function getQuantidadeChaves()
    {
        return $this->quantidadeChaves;
    }

    public function getQuantidadeClassificadosChave()
    {
        return $this->quantidadeClassificadosChave;
    }

    public function getDesempate1()
    {
        return $this->desempate1;
    }

    public function getDesempate2()
    {
        return $this->desempate2;
    }

    public function getDesempate3()
    {
        return $this->desempate3;
    }

    public function getEquipes()
    {
        return $this->equipes;
    }

    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    public function getUsuarioExclusao()
    {
        return $this->usuarioExclusao;
    }

    public function setEdicao($edicao)
    {
        $this->edicao = $edicao;
        return $this;
    }

    public function setCampeonato(Campeonato $campeonato)
    {
        $this->campeonato = $campeonato;
        return $this;
    }

    public function setTipo($tipo)
    {
        if (!in_array($tipo, array(self::TORNEIO, self::CHAVE))) {
            throw new InvalidArgumentException("Tipo Inválido");
        }

        $this->tipo = $tipo;
        return $this;
    }

    public function setQuantidadeEquipes($quantidadeEquipes)
    {
        $this->quantidadeEquipes = $quantidadeEquipes;
        return $this;
    }

    public function setQuantidadeChaves($quantidadeChaves)
    {
        $this->quantidadeChaves = $quantidadeChaves;
        return $this;
    }

    public function setQuantidadeClassificadosChave($quantidadeClassificadosChave)
    {
        $this->quantidadeClassificadosChave = $quantidadeClassificadosChave;
        return $this;
    }

    public function setDesempate1($desempate1)
    {
        if (!in_array($desempate1, array(self::VITORIA, self::DISCIPLINA, self::SALDO_GOLS))) {
            throw new InvalidArgumentException("Desempate 1 Inválido");
        }
        $this->desempate1 = $desempate1;
        return $this;
    }

    public function setDesempate2($desempate2)
    {
        if (!in_array($desempate2, array(self::VITORIA, self::DISCIPLINA, self::SALDO_GOLS))) {
            throw new InvalidArgumentException("Desempate 2 Inválido");
        }
        $this->desempate2 = $desempate2;
        return $this;
    }

    public function setDesempate3($desempate3)
    {
        if (!in_array($desempate3, array(self::VITORIA, self::DISCIPLINA, self::SALDO_GOLS))) {
            throw new InvalidArgumentException("Desempate 3 Inválido");
        }
        $this->desempate3 = $desempate3;
        return $this;
    }

    public function setEquipes($equipes)
    {
        $this->equipes = $equipes;
        return $this;
    }

    public function setUsuarioCadastro(Usuario $usuarioCadastro)
    {
        $this->usuarioCadastro = $usuarioCadastro;
        return $this;
    }

    public function setUsuarioExclusao(Usuario $usuarioExclusao)
    {
        $this->usuarioExclusao = $usuarioExclusao;
        return $this;
    }

    public function getModalidade()
    {
        return $this->modalidade;
    }

    public function setModalidade($modalidade)
    {
        if (!in_array($modalidade, array(EnumSexoType::MASCULINO, EnumSexoType::FEMININO))) {
            throw new InvalidArgumentException("Modalidade  Inválida");
        }
        $this->modalidade = $modalidade;
        return $this;
    }
    
    public function getQuantidadeMinimaJogadores() {
        return $this->quantidadeMinimaJogadores;
    }

    public function getQuantidadeMaximaJogadores() {
        return $this->quantidadeMaximaJogadores;
    }

    public function setQuantidadeMinimaJogadores($quantidadeMinimaJogadores) {
        $this->quantidadeMinimaJogadores = $quantidadeMinimaJogadores;
        return $this;
    }

    public function setQuantidadeMaximaJogadores($quantidadeMaximaJogadores) {
        $this->quantidadeMaximaJogadores = $quantidadeMaximaJogadores;
        return $this;
    }

    public function getLabel()
    {
        $this->campeonato->getNome()." - ".$this->edicao;
    }

    public function getOitavas()
    {
        return $this->oitavas;
    }

    public function getQuartas()
    {
        return $this->quartas;
    }

    public function getSemiFinal()
    {
        return $this->semiFinal;
    }

    public function getFinal()
    {
        return $this->final;
    }

    public function setOitavas($oitavas)
    {
        $this->oitavas = $oitavas;
        return $this;
    }

    public function setQuartas($quartas)
    {
        $this->quartas = $quartas;
        return $this;
    }

    public function setSemiFinal($semiFinal)
    {
        $this->semiFinal = $semiFinal;
        return $this;
    }

    public function setFinal($final)
    {
        $this->final = $final;
        return $this;
    }


    public function getFaseDeGrupos()
    {
        return $this->faseDeGrupos;
    }

    public function setFaseDeGrupos($faseDeGrupos)
    {
        $this->faseDeGrupos = $faseDeGrupos;
        return $this;
    }


    public function getChaves()
    {
        return $this->chaves;
    }

    public function setChaves(Collection $chaves)
    {
        $this->chaves = $chaves;
        return $this;
    }


    
    
}
