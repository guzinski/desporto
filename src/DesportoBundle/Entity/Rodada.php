<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Rodada
 * @ORM\Table(name="rodada")
 * @ORM\Entity
 * @author Luciano
 */
class Rodada
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
        
    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="rodadas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edica_campeonato", referencedColumnName="id")
     * })
     */
    private $edicaoCampeonato;

    /**
     * @var string
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numero;    

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Jogo", mappedBy="rodada")
     **/
    private $jogos;

    
    public function __construct()
    {
        $this->jogos = new ArrayCollection();
    }
    
    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function getJogos()
    {
        return $this->jogos;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }

    public function setJogos(Collection $jogos)
    {
        $this->jogos = $jogos;
        return $this;
    }


    
}
