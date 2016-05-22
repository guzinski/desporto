<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Profissional
 *
 * @ORM\Table(name="equipe")
 * 
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\EquipeRepository")
 */
class Equipe extends BaseEntity
{
    
    /**
     * @var string
     * @Assert\NotBlank(message="Nome da equipe deve ser preenchido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nome;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Nome do resposável deve ser preenchido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $responsavel;

    /**
     * @var string
     * @Assert\NotBlank(message="Deve ser colocado um brasão para a equipe")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $brasao;

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
     * @ORM\JoinTable(name="equipe_arquivo",
     *      joinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="arquivo", referencedColumnName="id", unique=true)}
     * )
     */
    private $arquivos;

    
    /**
     * @var DateTime
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

    
    public function getLabel()
    {
        return $this->nome;
    }

    
    public function getNome()
    {
        return $this->nome;
    }


    public function getBrasao()
    {
        return $this->brasao;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }


    public function setBrasao($brasao)
    {
        $this->brasao = $brasao;
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

    public function getResponsavel()
    {
        return $this->responsavel;
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

    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    public function setArquivos($arquivos)
    {
        $this->arquivos = $arquivos;
        return $this;
    }

    public function setDataExclusao(DateTime $dataExclusao)
    {
        $this->dataExclusao = $dataExclusao;
        return $this;
    }

    public function setUsuario(Usuario $usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }



    
}
