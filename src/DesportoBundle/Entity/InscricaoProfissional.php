<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * @ORM\Table(name="inscricao_profissional", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="profissional_campeonato_equipe", columns={"edicao_campeonato", "equipe", "profissional", "tipo"})})
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\InscricaoProfissionalRepository")
 * @UniqueEntity({"edicaoCampeonato", "equipe", "profissional", "tipo"})
 */
class InscricaoProfissional
{
    const JOGADOR = "J";
    const TREINADOR = "T";
    const DIRETOR = "D";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    protected $id;

    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="inscricoes")
     * @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id", nullable=false)
     */
    protected $edicaoCampeonato;
    
    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="inscricoes")
     * @ORM\JoinColumn(name="equipe", referencedColumnName="id", nullable=false)
     */
    protected $equipe;
    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="inscricoes")
     * @ORM\JoinColumn(name="profissional", referencedColumnName="id", nullable=false)
     */
    protected $profissional;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('J', 'T', 'D')", nullable=false)
     */
    protected $tipo;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Gol", mappedBy="jogo")
     **/
    private $gols;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Jogo", mappedBy="inscricoes")
     **/
    private $jogo;

    
    public function __construct(EdicaoCampeonato $edicaoCampeonato, Equipe $equipe, Profissional $profissional, $tipo)
    {
        $this->setEdicaoCampeonato($edicaoCampeonato);
        $this->setEquipe($equipe);
        $this->setProfissional($profissional);
        $this->setTipo($tipo);
        $this->setGols(new \Doctrine\Common\Collections\ArrayCollection());
    }

    public function getId()
    {
        return $this->id;
    }

    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function getEquipe()
    {
        return $this->equipe;
    }

    public function getProfissional()
    {
        return $this->profissional;
    }

    public function getTipo()
    {
        return $this->tipo;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }

    public function setEquipe(Equipe $equipe)
    {
        $this->equipe = $equipe;
        return $this;
    }

    public function setProfissional(Profissional $profissional)
    {
        $this->profissional = $profissional;
        return $this;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }
    
    public function getGols()
    {
        return $this->gols;
    }

    public function setGols(Collection $gols)
    {
        $this->gols = $gols;
        return $this;
    }

    
    public function getJogo()
    {
        return $this->jogo;
    }

    public function setJogo(Collection $jogo)
    {
        $this->jogo = $jogo;
        return $this;
    }

}
