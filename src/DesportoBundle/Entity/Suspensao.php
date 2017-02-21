<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Suspensao
 * @ORM\Table(name="suspensao")
 * @ORM\Entity)
 */
class Suspensao extends BaseEntity
{
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Cartao", mappedBy="suspensao")
     **/
    private $cartoes;
    
    /**
     * @var InscricaoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional", inversedBy="suspensoes")
     * @ORM\JoinColumn(name="inscricao_profissional", referencedColumnName="id", nullable=false)
     */
    private $inscricaoprofissional;    

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
     * @var DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;

    public function __construct()
    {
        parent::__construct();
        $this->jogosCumpridos = new ArrayCollection();
    }

    
    public function getCartoes()
    {
        return $this->cartoes;
    }

    public function getInscricaoprofissional()
    {
        return $this->inscricaoprofissional;
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

    public function setInscricaoprofissional(InscricaoProfissional $inscricaoprofissional)
    {
        $this->inscricaoprofissional = $inscricaoprofissional;
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

    public function setData(DateTime $data)
    {
        $this->data = $data;
        return $this;
    }

        
    public function getLabel()
    {
        return $this->id;
    }

    
    
    
}
