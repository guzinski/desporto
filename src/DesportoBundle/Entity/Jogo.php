<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Jogo
 * @ORM\Table(name="jogo")
 * @ORM\Entity
 */
class Jogo
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
     *   @ORM\JoinColumn(name="equipe_mandante", referencedColumnName="id")
     * })
     */
    private $equipeMandante;
    
    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="equipe_visitante", referencedColumnName="id")
     * })
     */
    private $equipeVisitante;
    
          
    /**
     * @var Rodada
     *
     * @ORM\ManyToOne(targetEntity="Rodada", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="rodada", referencedColumnName="id")
     * })
     */
    private $rodada;
    
    /**
     * @var FaseClassificatoria
     *
     * @ORM\ManyToOne(targetEntity="FaseClassificatoria", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fase_classificatoria", referencedColumnName="id")
     * })
     */
    private $faseClassificatoria;

    
    
    
    
    
}
