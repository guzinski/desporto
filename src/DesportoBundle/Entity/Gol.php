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
     * @var InscricaoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional", inversedBy="gols")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inscricao_profissional", referencedColumnName="id")
     * })
     */
    private $inscricao;    
    
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
    
    /**
     * @var string
     * 
     * @ORM\Column(type="string", columnDefinition="ENUM('1', '2')", nullable=false)
     */
    protected $tempo;

    /**
     * @var int
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $contra;

    
    public function getId()
    {
        return $this->id;
    }

    public function getInscricao()
    {
        return $this->inscricao;
    }

    public function getJogo()
    {
        return $this->jogo;
    }

    public function getMinuto()
    {
        return $this->minuto;
    }

    public function getTempo()
    {
        return $this->tempo;
    }

    public function getContra()
    {
        return $this->contra;
    }

    public function setInscricao(InscricaoProfissional $inscricao)
    {
        $this->inscricao = $inscricao;
        return $this;
    }

    public function setJogo(Jogo $jogo)
    {
        $this->jogo = $jogo;
        return $this;
    }

    public function setMinuto($minuto)
    {
        $this->minuto = $minuto;
        return $this;
    }

    public function setTempo($tempo)
    {
        $this->tempo = $tempo;
        return $this;
    }

    public function setContra($contra)
    {
        $this->contra = $contra;
        return $this;
    }


    
    
    
}
