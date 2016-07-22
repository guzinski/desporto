<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Chave
 * @ORM\Table(name="chave")
 * @ORM\Entity
 */
class Chave
{
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    
    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="chaves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")
     * })
     */
    private $edicaoCampeonato;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Equipe", inversedBy="chaves")
     * @ORM\JoinTable(name="chave_equipe",
     *      joinColumns={@ORM\JoinColumn(name="chave", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id", unique=true)}
     * )
     */
    private $equipes;
    
    /**
     * número da chave
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numero;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Jogo", cascade={"all"}, mappedBy="chave")
     **/
    private $jogos;

    public function __construct()
    {
        $this->jogos = new ArrayCollection();
    }
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLabel()
    {
        return (string) $this->getNumero();
    }

    public function getEquipes()
    {
        return $this->equipes;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setEquipes($equipes)
    {
        $this->equipes = $equipes;
        return $this;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }
    
    public function getJogos()
    {
        return $this->jogos;
    }

    public function setJogos(Collection $jogos)
    {
        $this->jogos = $jogos;
        return $this;
    }





    
    
}
