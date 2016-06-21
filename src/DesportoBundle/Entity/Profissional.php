<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use InvalidArgumentException;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Profissional
 *
 * @ORM\Table(name="profissional")
 * @UniqueEntity(fields={"cpf"}, message="Este CPF já está cadastrado", repositoryMethod="uniqueEntity")
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\ProfissionalRepository")
 */
class Profissional extends BaseEntity
{
    
    const DIRETOR = "DIRETOR";
    const TECNICO = "TECNICO";
    const JOGADOR = "JOGADOR";
    
    /**
     * @var string
     * @Assert\NotBlank(message="Nome deve ser preenchido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nome;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Deve ser colocado uma foto para o profissional")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $foto;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", nullable=false)
     */
    private $nascimento;
    
    /**
     *  @ORM\Column(type="sexotype", nullable=false)
     */
    private $sexo;

    
    /**
     * @var string
     * @Assert\NotBlank(message="CPF deve ser PReenchido")
     * @ORM\Column(type="string", length=11, nullable=false)
     */
    private $cpf;
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=12, nullable=true)
     */
    private $rg;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefone;
    
    /**
     * @ORM\ManyToMany(targetEntity="Arquivo", cascade={"all"})
     * @ORM\JoinTable(name="profissional_arquivo",
     *      joinColumns={@ORM\JoinColumn(name="profissional", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="arquivo", referencedColumnName="id", unique=true)}
     * )
     */
    private $arquivos;

    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="data_exclusao", type="datetime", nullable=true)
     */
    private $dataExclusao;
    
    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="profissionaisCadastradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioCadastro;
    
    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="profissionaisExcluidas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioExclusao;

    
    public function __construct()
    {
        parent::__construct();
        $this->setArquivos(new ArrayCollection());
    }

    public function getNome()
    {
        return $this->nome;
    }

    public function getFoto()
    {
        return $this->foto;
    }

    public function getNascimento()
    {
        return $this->nascimento;
    }

    public function getCpf()
    {
        return $this->cpf;
    }

    public function getRg()
    {
        return $this->rg;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function getArquivos()
    {
        return $this->arquivos;
    }

    public function getDataExclusao()
    {
        return $this->dataExclusao;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setFoto($foto)
    {
        $this->foto = $foto;
        return $this;
    }

    public function setNascimento(DateTime $nascimento)
    {
        $this->nascimento = $nascimento;
        return $this;
    }

    public function setCpf($cpf)
    {
        $this->cpf = preg_replace("/[^0-9]/", "", $cpf);
        return $this;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = preg_replace("/[^0-9]/", "", $telefone);;
        return $this;
    }

    public function setArquivos(Collection $arquivos)
    {
        $this->arquivos = $arquivos;
        return $this;
    }

    public function setDataExclusao(\DateTime $dataExclusao)
    {
        $this->dataExclusao = $dataExclusao;
        return $this;
    }

    public function getLabel()
    {
        $this->nome." - ".$this->cpf;
    }


    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    public function getUsuarioExclusao()
    {
        return $this->usuarioExclusao;
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

    public function getSexo()
    {
        return $this->sexo;
    }

    public function setSexo($sexo)
    {
        if (!in_array($sexo, array(\DesportoBundle\Doctrine\Type\EnumSexoType::MASCULINO, \DesportoBundle\Doctrine\Type\EnumSexoType::FEMININO))) {
            throw new InvalidArgumentException("Sexo Inválida");
        }
        
        $this->sexo = $sexo;
        return $this;
    }


    
}
