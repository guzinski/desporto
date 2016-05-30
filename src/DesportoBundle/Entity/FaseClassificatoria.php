<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of FaseClassificatoria
 * @ORM\Table(name="fase_classificatoria")
 * @ORM\Entity
 */
class FaseClassificatoria
{
    
    const OITAVAS = "OITAVAS";
    const QUARTAS = "QUARTAS";
    const SEMI = "SEMI";
    const FINAL_ = "FINAL";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    public function getId()
    {
        return $this->id;
    }


}
