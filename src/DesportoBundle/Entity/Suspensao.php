<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Suspensao
 * @ORM\Table(name="suspensao")
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\SuspensaoRepository")
 */
class Suspensao extends BaseEntity
{
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Cartao", mappedBy="suspensao", cascade={"persist"})
     **/
    private $cartoes;
    
    /**
     * @var InscricaoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional", inversedBy="suspensoes")
     * @ORM\JoinColumn(name="inscricao_profissional", referencedColumnName="id", nullable=false)
     */
    private $inscricao;    

    /**
     * @var Collection Description
     * @ORM\ManyToMany(targetEntity="Jogo", inversedBy="suspensoes")
     * @ORM\JoinTable(name="suspensao_jogo_cumprido",
     *      joinColumns={@ORM\JoinColumn(name="suspensao", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="jogo", referencedColumnName="id")}
     * )
     */
    private $jogosCumpridos;

    
    /**
     * @var int
     * 
     * @ORM\Column(name="quantidade_jogos", type="integer", nullable=false)
     */
    private $quantidadeJogos;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="julgamento", type="boolean", nullable=false)
     */
    private $julgamento = FALSE;
    
    /**
     * @var boolean
     * 
     * @ORM\Column(name="julgada", type="boolean", nullable=true)
     */
    private $julgada;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;
    
    /**
     * @var string
     *
     * @ORM\Column(type="text", nullable=true)
     */
    private $observacoes;

    public function __construct()
    {
        parent::__construct();
        $this->jogosCumpridos = new ArrayCollection();
        $this->cartoes = new ArrayCollection();
    }
    
    

    /**
     * 
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getCartoes()
    {
        return $this->cartoes;
    }

    public function getInscricao()
    {
        return $this->inscricao;
    }

    public function getJogosCumpridos()
    {
        return $this->jogosCumpridos;
    }

    public function getQuantidadeJogos()
    {
        return $this->quantidadeJogos;
    }

    public function getData()
    {
        return $this->data;
    }

    public function setCartoes(Collection $cartoes)
    {
        $this->cartoes = $cartoes;
        return $this;
    }

    public function setInscricao(InscricaoProfissional $inscricaoprofissional)
    {
        $this->inscricao = $inscricaoprofissional;
        return $this;
    }

    public function setJogosCumpridos(Collection $jogosCumpridos)
    {
        $this->jogosCumpridos = $jogosCumpridos;
        return $this;
    }

    public function setQuantidadeJogos($quantidadeJogos)
    {
        $this->quantidadeJogos = $quantidadeJogos;
        return $this;
    }

    public function setData(DateTime $data = null)
    {
        $this->data = $data;
        return $this;
    }

    public function setJulgamento($julgamento)
    {
        $this->julgamento = $julgamento;
        return $this;
    }

    public function setJulgada($julgada)
    {
        $this->julgada = $julgada;
        return $this;
    }
    
    public function isJulgada()
    {
        return $this->julgada;
    }
    
    public function isJulgamento()
    {
        return $this->julgamento;
    }


    
    
        
    public function getLabel()
    {
        return $this->id;
    }

    
    public function addCartao(Cartao $cartao)
    {
        $cartao->setSuspensao($this);
        $this->getCartoes()->add($cartao);
    }
    
    
    public function getObservacoes()
    {
        return $this->observacoes;
    }

    public function setObservacoes($observacoes)
    {
        $this->observacoes = $observacoes;
        return $this;
    }


    
    
}
