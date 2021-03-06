<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Cartao
 * @ORM\Table(name="cartao")
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\CartaoRepository")
 */
class Cartao extends BaseEntity
{
    const VERMELHO = "V";
    const AMARELO = "A";
        
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('A', 'V')", nullable=false)
     */
    private $cor;

    /**
     * @var InscricaoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional", inversedBy="cartoes",fetch="EAGER")
     * @ORM\JoinColumn(name="inscricao_profissional", referencedColumnName="id", nullable=false)
     * 
     */
    private $inscricao;    

    /**
     * @var Jogo
     *
     * @ORM\ManyToOne(targetEntity="Jogo", inversedBy="cartoes")
     * @ORM\JoinColumn(name="jogo", referencedColumnName="id", nullable=false)
     * 
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
     * @var Suspensao
     *
     * @ORM\ManyToOne(targetEntity="Suspensao", inversedBy="cartoes")
     * @ORM\JoinColumn(name="suspensao", referencedColumnName="id", nullable=true)
     */
    private $suspensao;


    public function getCor()
    {
        return $this->cor;
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

    public function setCor($cor)
    {
        $this->cor = $cor;
        return $this;
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

    public function getSuspensao()
    {
        return $this->suspensao;
    }

    public function setSuspensao(Suspensao $suspensao)
    {
        $this->suspensao = $suspensao;
        return $this;
    }

    public function getLabel()
    {
        return $this->inscricao->getProfissional()->getNome(). " "  .$this->cor;
    }

    
    
}
