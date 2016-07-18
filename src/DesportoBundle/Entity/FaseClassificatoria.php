<?php


namespace DesportoBundle\Entity;


use DesportoBundle\Entity\FaseClassificatoria;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of FaseClassificatoria
 * @ORM\Table(name="fase_classificatoria")
 * @ORM\Entity
 */
class FaseClassificatoria
{
    const OITAVAS = "OITAVAS";
    const QUARTAS = "QUARTAS";
    const SEMIFINAL = "SEMIFINAL";
    const FINAL_ = "FINAL";

    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     */
    private $id;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('OITAVAS', 'QUARTAS', 'SEMIFINAL', 'FINAL')", nullable=false)
     */
    private $tipo;

    /**
     *  @ORM\Column(name="jogo_unico", type="boolean", nullable=false)
     */
    private $jogoUnico = FALSE;

    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="fasesClassificatorias")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edica_campeonato", referencedColumnName="id", nullable=false)
     * })
     */
    private $edicaoCampeonato;
    
    /**
     * @var FaseClassificatoria
     *
     * @ORM\ManyToOne(targetEntity="FaseClassificatoria", inversedBy="fasesPai")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fase_filha", referencedColumnName="id")
     * })
     */
    private $faseFilha;
            
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="FaseClassificatoria", mappedBy="faseFilha")
     **/
    private $fasesPai;
    
    /**
     * @var Jogo
     * @ORM\OneToOne(targetEntity="Jogo")
     * @ORM\JoinColumn(name="primeiro_jogo", referencedColumnName="id", nullable=false)
     */
    private $primeiroJogo;
    
    /**
     * @var Jogo
     * @ORM\OneToOne(targetEntity="Jogo")
     * @ORM\JoinColumn(name="segundo_jogo", referencedColumnName="id")
     */
    private $segundoJogo;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Equipe", inversedBy="fasesClassificatorias")
     * @ORM\JoinTable(name="fase_classificatoria_equipe")
     */
    private $equipes;


    public function getId()
    {
        return $this->id;
    }
    
    
    public function getTipo()
    {
        return $this->tipo;
    }

    public function getJogoUnico()
    {
        return $this->jogoUnico;
    }

    public function getFaseFilha()
    {
        return $this->faseFilha;
    }

    public function getFasesPai()
    {
        return $this->fasesPai;
    }

    public function setTipo($tipo)
    {
        $this->tipo = $tipo;
        return $this;
    }

    public function setJogoUnico($jogoUnico)
    {
        $this->jogoUnico = $jogoUnico;
        return $this;
    }

    public function setFaseFilha(FaseClassificatoria $faseFilha)
    {
        $this->faseFilha = $faseFilha;
        return $this;
    }

    public function setFasesPai(Collection $fasesPai)
    {
        $this->fasesPai = $fasesPai;
        return $this;
    }

    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }

    public function setPrimeiroJogo($primeiroJogo)
    {
        $this->primeiroJogo = $primeiroJogo;
        return $this;
    }

    public function setSegundoJogo($segundoJogo)
    {
        $this->segundoJogo = $segundoJogo;
        return $this;
    }

    public function getEquipes()
    {
        return $this->equipes;
    }

    public function setEquipes(Collection $equipes)
    {
        $this->equipes = $equipes;
        return $this;
    }


    


}
