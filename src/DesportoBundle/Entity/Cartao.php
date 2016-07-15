<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Cartao
 * @ORM\Table(name="cartao")
 * @ORM\Entity
 */
class Cartao
{
    const VERMELHO = "V";
    const AMARELO = "A";
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('A', 'V')", nullable=false)
     */
    private $cor;

    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="cartoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profissional", referencedColumnName="id")
     * })
     */
    private $profissional;

    
    /**
     * @var Jogo
     *
     * @ORM\ManyToOne(targetEntity="Jogo", inversedBy="cartoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="jogo", referencedColumnName="id")
     * })
     */
    private $jogo;

    /**
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $minuto;

    
    
}
