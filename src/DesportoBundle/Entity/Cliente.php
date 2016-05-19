<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Cliente
 *
 * @ORM\Table(name="cliente")
 * @UniqueEntity(fields={"cpf"}, message="Este CPF já está cadastrado", repositoryMethod="uniqueEntity")
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\ClienteRepository")
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
     * @Assert\NotBlank(message="Deve ser colocado uma foto para o cliente")
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
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    private $cep;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=2, nullable=true)
     */
    private $uf;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=100, nullable=true)
     */
    private $cidade;

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
     * @var Collection
     * 
     * @ORM\OneToMany(targetEntity="Arquivo", mappedBy="cliente", cascade={"all"})
     **/
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
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="produtos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuario;

    
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

    public function getCep()
    {
        return $this->cep;
    }

    public function getUf()
    {
        return $this->uf;
    }

    public function getCidade()
    {
        return $this->cidade;
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

    public function getUsuario()
    {
        return $this->usuario;
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
        $this->cpf = $cpf;
        return $this;
    }

    public function setRg($rg)
    {
        $this->rg = $rg;
        return $this;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;
        return $this;
    }

    public function setUf($uf)
    {
        $this->uf = $uf;
        return $this;
    }

    public function setCidade($cidade)
    {
        $this->cidade = $cidade;
        return $this;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
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

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function getLabel()
    {
        $this->nome." - ".$this->cpf;
    }


    
    
}
