<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;



/**
 * Description of EdicaoCampeonatoEquipeProfissional
 * @ORM\Table(name="edicao_campeonato_equipe_profissional", uniqueConstraints={
 *     @ORM\UniqueConstraint(name="profissional_campeonato_equipe", columns={"edicao_campeonato", "equipe", "profissional", "tipo"})})
 * @ORM\Entity
 * @UniqueEntity({"edicaoCampeonato", "equipe", "profissional", "tipo"})
 */
class EdicaoCampeonatoEquipeProfissional
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
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato")
     * @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id", nullable=false)
     */
    protected $edicaoCampeonato;
    
    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="campeonatosProfissionais")
     * @ORM\JoinColumn(name="equipe", referencedColumnName="id", nullable=false)
     */
    protected $equipe;
    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="equipes")
     * @ORM\JoinColumn(name="profissional", referencedColumnName="id", nullable=false)
     */
    protected $profissional;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('J', 'T', 'D')", nullable=false)
     */
    protected $tipo;
    
    public function __construct(EdicaoCampeonato $edicaoCampeonato, Equipe $equipe, Profissional $profissional, $tipo)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        $this->equipe = $equipe;
        $this->profissional = $profissional;
        $this->tipo = $tipo;
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
    
}
