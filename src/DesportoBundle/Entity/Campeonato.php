<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Campeonato
 * @ORM\Table(name="campeonato")
 * @ORM\Entity
 * @author Luciano
 */
class Campeonato
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
     * @var string
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;

    /**
     * @var Modalidade
     *
     * @ORM\ManyToOne(targetEntity="Modalidade", inversedBy="campeonatos", cascade={"all"})
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="modalidade", referencedColumnName="id")
     * })
     */
    private $modalidade;

    public function __construct($nome = null, Modalidade $modalidade = null)
    {
        if (!is_null($nome)) {
            $this->setNome($nome);
        }
        if (!is_null($modalidade)) {
            $this->setModalidade($modalidade);
        }
    }

    
    public function getId()
    {
        return $this->id;
    }
        
    public function getNome()
    {
        return $this->nome;
    }

    public function getModalidade()
    {
        return $this->modalidade;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function setModalidade(Modalidade $modalidade)
    {
        $this->modalidade = $modalidade;
        return $this;
    }
    
    public function __toString()
    {
        return $this->getNome();
    }
    
    public function getCampeonato()
    {
        return $this;
    }

}
