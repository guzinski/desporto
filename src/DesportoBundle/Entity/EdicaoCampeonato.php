<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Description of EdicaoCampeonato
 * @ORM\Table(name="edicao_campeonato")
 * @ORM\Entity
 * @author Luciano
 */
class EdicaoCampeonato extends BaseEntity
{
    
    const MASCULINO = "F";
    const FEMININO = "M";
    
    const TORNEIO = "T";
    const CHAVE = "C";
    
    
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
     * @ORM\ManyToOne(targetEntity="Campeonato", inversedBy="edicoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato", referencedColumnName="id")
     * })
     */
    private $campeonato;

    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('F', 'M')", nullable=false)
     */
    private $categoria;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('T', 'C')", nullable=false)
     */
    private $tipo;

    
    /**
     * 
     * @var int
     * número de equipes inscritas
     * @ORM\Column(name="quantidade_equipes", type="integer", nullable=false)
     */
    private $quantidadeEquipes;
    
    /**
     * @var int
     * quantidade máxima de jogadores por equipe
     * @ORM\Column(name="quantidade_jogadores", type="integer", nullable=false)
     */
    private $quantidadeJogadores;
    
    /**
     * número de chaves do campeonato
     * @var int
     * 
     * @ORM\Column(name="quantidade_chaves", type="integer", nullable=true)
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


    
    public function getEdicao()
    {
        return $this->edicao;
    }

    public function getCampeonato()
    {
        return $this->campeonato;
    }

    public function getCategoria()
    {
        return $this->categoria;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function getQuantidadeEquipes()
    {
        return $this->quantidadeEquipes;
    }

    public function getQuantidadeJogadores()
    {
        return $this->quantidadeJogadores;
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

    public function setCategoria($categoria)
    {
        $this->categoria = $categoria;
        return $this;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function setQuantidadeEquipes($quantidadeEquipes)
    {
        $this->quantidadeEquipes = $quantidadeEquipes;
        return $this;
    }

    public function setQuantidadeJogadores($quantidadeJogadores)
    {
        $this->quantidadeJogadores = $quantidadeJogadores;
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
        $this->desempate1 = $desempate1;
        return $this;
    }

    public function setDesempate2($desempate2)
    {
        $this->desempate2 = $desempate2;
        return $this;
    }

    public function setDesempate3($desempate3)
    {
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

        
    
    public function getLabel()
    {
        $this->campeonato->getNome()." - ".$this->edicao;
    }

    
    
    
}
