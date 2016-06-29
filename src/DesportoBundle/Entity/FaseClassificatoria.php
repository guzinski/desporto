<?php

use DesportoBundle\Entity\FaseClassificatoria;
use Doctrine\Common\Collections\Collection;

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Entity;

/**
 * Description of FaseClassificatoria
 * @ORM\Table(name="fase_classificatoria")
 * @ORM\Entity
 */
class FaseClassificatoria
{
    const OITAVAS = "OITAVAS";
    const QUARTAS = "QUARTAS";
    const SEMIFINAL = "SEMIFINAL";
    const FINAL_ = "FINAL";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('O', 'Q', 'S', 'F')", nullable=false)
     */
    private $tipo;

    /**
     *  @ORM\Column(name="jogo_unico", type="boolean", nullable=false)
     */
    private $jogoUnico = FALSE;

    /**
     * @var FaseClassificatoria
     *
     * @ORM\ManyToOne(targetEntity="FaseClassificatoria", inversedBy="fasesPai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fase_filha", referencedColumnName="id")
     * })
     */
    private $faseFilha;
            
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="FaseClassificatoria", mappedBy="faseFilha")
     **/
    private $fasesPai;


    public function getId()
    {
        return $this->id;
    }
    
    
    public function getTipo()
    {
        return $this->tipo;
    }

    public function getJogoUnico()
    {
        return $this->jogoUnico;
    }

    public function getFaseFilha()
    {
        return $this->faseFilha;
    }

    public function getFasesPai()
    {
        return $this->fasesPai;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function setJogoUnico($jogoUnico)
    {
        $this->jogoUnico = $jogoUnico;
        return $this;
    }

    public function setFaseFilha(FaseClassificatoria $faseFilha)
    {
        $this->faseFilha = $faseFilha;
        return $this;
    }

    public function setFasesPai(Collection $fasesPai)
    {
        $this->fasesPai = $fasesPai;
        return $this;
    }

    

    


}
