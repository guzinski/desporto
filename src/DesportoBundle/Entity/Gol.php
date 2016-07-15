<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Gol
 * @ORM\Table(name="gol")
 * @ORM\Entity
 */
class Gol
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
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe", referencedColumnName="id")
     * })
     */
    private $equipe;
    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="gols")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profissional", referencedColumnName="id")
     * })
     */
    private $profissional;
    
    /**
     * @var Jogo
     *
     * @ORM\ManyToOne(targetEntity="Jogo", inversedBy="gols")
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
