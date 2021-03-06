<?php

namespace DesportoBundle\Entity;

use DesportoBundle\Repository\InscricaoProfissionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="inscricoes", fetch="EAGER")
     * @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id", nullable=false)
     */
    protected $edicaoCampeonato;
    
    /**
     * @var Equipe
     *
     * @ORM\ManyToOne(targetEntity="Equipe", inversedBy="inscricoes", fetch="EAGER")
     * @ORM\JoinColumn(name="equipe", referencedColumnName="id", nullable=false)
     */
    protected $equipe;
    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="inscricoes", fetch="EAGER")
     * @ORM\JoinColumn(name="profissional", referencedColumnName="id", nullable=false)
     */
    protected $profissional;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('J', 'T', 'D')", nullable=false)
     */
    protected $tipo;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Gol", mappedBy="inscricao")
     **/
    private $gols;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Cartao", mappedBy="inscricao")
     **/
    private $cartoes;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="ProfissionalJogo", mappedBy="jogo")
     **/
    private $profissionalJogos;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Suspensao", cascade={"all"}, mappedBy="inscricao")
     **/
    private $suspensoes;

    
    public function __construct(EdicaoCampeonato $edicaoCampeonato, Equipe $equipe, Profissional $profissional, $tipo)
    {
        $this->setEdicaoCampeonato($edicaoCampeonato);
        $this->setEquipe($equipe);
        $this->setProfissional($profissional);
        $this->setTipo($tipo);
        $this->setGols(new ArrayCollection());
        $this->setCartoes(new ArrayCollection());
        $this->setSuspensoes(new ArrayCollection());
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

    public function getGols()
    {
        return $this->gols;
    }

    public function getProfissionalJogos()
    {
        return $this->profissionalJogos;
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

    public function setGols(Collection $gols)
    {
        $this->gols = $gols;
        return $this;
    }

    public function setProfissionalJogos(Collection $profissionalJogos)
    {
        $this->profissionalJogos = $profissionalJogos;
        return $this;
    }

    public function getCartoes()
    {
        return $this->cartoes;
    }

    public function setCartoes(Collection $cartoes)
    {
        $this->cartoes = $cartoes;
        return $this;
    }
    
    public function getCartoesAmarelos()
    {
        return $this->cartoes->filter(function (Cartao $cartao) {
            return $cartao->getCor() == Cartao::AMARELO;
        });
    }
    
    public function getCartoesVermelhos()
    {
        return $this->cartoes->filter(function (Cartao $cartao) {
            return $cartao->getCor() == Cartao::VERMELHO;
        });
    }
    
    public function getSuspensoes()
    {
        return $this->suspensoes;
    }

    public function setSuspensoes(Collection $suspensoes)
    {
        $this->suspensoes = $suspensoes;
        return $this;
    }

    
    
    public function __toString()
    {
        return $this->getProfissional()->getNome();
    }
    
}
