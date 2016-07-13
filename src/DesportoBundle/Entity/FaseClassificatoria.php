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
     *  @ORM\Column(type="string", columnDefinition="ENUM('O', 'Q', 'S', 'F')", nullable=false)
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
     *   @ORM\JoinColumn(name="edica_campeonato", referencedColumnName="id")
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
     * @var Collection
     * @ORM\OneToMany(targetEntity="Jogo", mappedBy="faseClassificatoria")
     **/
    private $jogos;



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



    


}
