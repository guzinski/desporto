<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="profissional_jogo", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="profissional_jogo", columns={"inscricao", "jogo"})})
 * @ORM\Entity
 * @UniqueEntity({"inscricao", "jogo"})
 */
class ProfissionalJogo {
    
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var InscricaoProfissional
     *
     * @ORM\ManyToOne(targetEntity="InscricaoProfissional")
     * @ORM\JoinColumn(name="inscricao", referencedColumnName="id", nullable=false)
     */
    protected $inscricao;
    

    /**
     * @var Jogo
     *
     * @ORM\ManyToOne(targetEntity="Jogo", inversedBy="profissionalJogos")
     * @ORM\JoinColumn(name="jogo", referencedColumnName="id", nullable=false)
     */
    protected $jogo;

    /**
     * @var integer
     *
     * @ORM\Column(name="numero", type="integer", nullable=false)
     */
    protected $numero;
    
    /**
     * @var boolean
     *
     * @ORM\Column(type="boolean", nullable=false)
     */
    protected $capitao;

    
    public function __construct(InscricaoProfissional $inscricao = null)
    {
        $this->inscricao = $inscricao;
    }

    public function getId() {
        return $this->id;
    }
    
    public function getInscricao() {
        return $this->inscricao;
    }

    public function getJogo() {
        return $this->jogo;
    }

    public function getNumero() {
        return $this->numero;
    }

    public function getCapitao() {
        return $this->capitao;
    }

    public function setInscricao(InscricaoProfissional $inscricao) {
        $this->inscricao = $inscricao;
        return $this;
    }

    public function setJogo(Jogo $jogo) {
        $this->jogo = $jogo;
        return $this;
    }

    public function setNumero($numero) {
        $this->numero = $numero;
        return $this;
    }

    public function setCapitao($capitao) {
        $this->capitao = $capitao;
        return $this;
    }



}
