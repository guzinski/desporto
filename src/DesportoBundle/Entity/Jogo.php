<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
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
     * @var Chave
     *
     * @ORM\ManyToOne(targetEntity="Chave", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="chave", referencedColumnName="id")
     * })
     */
    private $chave;
    
    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")
     * })
     */
    private $edicaoCampeonato;

    /**
     * @var DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(type="time", nullable=true)
     */
    private $horario;
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $local;

    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Gol", mappedBy="jogo")
     **/
    private $gols;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Cartao", mappedBy="jogo")
     **/
    private $cartoes;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="InscricaoProfissional", mappedBy="jogo")
     **/
    private $inscricoes;


    public function __construct(Equipe $equipeMandante, Equipe $equipeVisitante)
    {
        $this->equipeMandante = $equipeMandante;
        $this->equipeVisitante = $equipeVisitante;
        $this->setInscricoes(new ArrayCollection());
    }

    
    public function getId()
    {
        return $this->id;
    }

    public function getEquipeMandante()
    {
        return $this->equipeMandante;
    }

    public function getEquipeVisitante()
    {
        return $this->equipeVisitante;
    }

    public function getRodada()
    {
        return $this->rodada;
    }

    public function getChave()
    {
        return $this->chave;
    }

    public function getEdicaoCampeonato()
    {
        return $this->edicaoCampeonato;
    }

    public function getData()
    {
        return $this->data;
    }

    public function getHorario()
    {
        return $this->horario;
    }

    public function getLocal()
    {
        return $this->local;
    }

    public function getGols()
    {
        return $this->gols;
    }

    public function getCartoes()
    {
        return $this->cartoes;
    }

    public function setEquipeMandante(Equipe $equipeMandante)
    {
        $this->equipeMandante = $equipeMandante;
        return $this;
    }

    public function setEquipeVisitante(Equipe $equipeVisitante)
    {
        $this->equipeVisitante = $equipeVisitante;
        return $this;
    }

    public function setRodada(Rodada $rodada)
    {
        $this->rodada = $rodada;
        return $this;
    }

    public function setChave(Chave $chave)
    {
        $this->chave = $chave;
        return $this;
    }

    public function setEdicaoCampeonato(EdicaoCampeonato $edicaoCampeonato)
    {
        $this->edicaoCampeonato = $edicaoCampeonato;
        return $this;
    }

    public function setData(DateTime $data)
    {
        $this->data = $data;
        return $this;
    }

    public function setHorario(DateTime $horario)
    {
        $this->horario = $horario;
        return $this;
    }

    public function setLocal($local)
    {
        $this->local = $local;
        return $this;
    }

    public function setGols(Collection $gols)
    {
        $this->gols = $gols;
        return $this;
    }

    public function setCartoes(Collection $cartoes)
    {
        $this->cartoes = $cartoes;
        return $this;
    }
    
    public function getInscricoes() {
        return $this->inscricoes;
    }

    public function setInscricoes(Collection $inscricoes) {
        $this->inscricoes = $inscricoes;
        return $this;
    }




    
    
}
