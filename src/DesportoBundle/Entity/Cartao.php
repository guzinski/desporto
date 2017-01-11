<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Description of Cartao
 * @ORM\Table(name="cartao")
 * @ORM\Entity
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
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional", inversedBy="cartoes")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="inscricao_profissional", referencedColumnName="id")
     * })
     */
    private $inscricao;    

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

    /**
     * @var string
     * 
     * @ORM\Column(type="string", columnDefinition="ENUM('1', '2')", nullable=false)
     */
    protected $tempo;

    
    function getCor()
    {
        return $this->cor;
    }

    function getInscricao()
    {
        return $this->inscricao;
    }

    function getJogo()
    {
        return $this->jogo;
    }

    function getMinuto()
    {
        return $this->minuto;
    }

    function setCor($cor)
    {
        $this->cor = $cor;
    }

    function setInscricao(InscricaoProfissional $inscricao)
    {
        $this->inscricao = $inscricao;
    }

    function setJogo(Jogo $jogo)
    {
        $this->jogo = $jogo;
    }

    function setMinuto($minuto)
    {
        $this->minuto = $minuto;
    }

        
    public function getLabel()
    {
        return $this->inscricao->getProfissional()->getNome(). " "  .$this->cor;
    }

    
}
