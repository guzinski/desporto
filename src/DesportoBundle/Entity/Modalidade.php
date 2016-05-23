<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Modalidade
 * @ORM\Table(name="modalidade")
 * @ORM\Entity
 * @author Luciano
 */
class Modalidade
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
     * @var Collection
     * @ORM\OneToMany(targetEntity="Campeonato", mappedBy="modalidade")
     **/
    private $campeonatos;

    
    
    public function __construct($nome = null)
    {
        if ($nome != null) {
            $this->setNome($nome);
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

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }
    
    public function getCampeonatos()
    {
        return $this->campeonatos;
    }

    public function setCampeonatos(Collection $campeonatos)
    {
        $this->campeonatos = $campeonatos;
        return $this;
    }


    
}
