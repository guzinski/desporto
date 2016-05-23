<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of EdicaoCampeonato
 * @ORM\Table(name="edicao_campeonato")
 * @ORM\Entity
 * @author Luciano
 */
class EdicaoCampeonato extends BaseEntity
{
    
    const MASCULINO = "F";
    const FEMININO = "M";
    
    const TORNEIO = "T";
    const CHAVE = "C";
    
    
    const VITORIA = "V";
    const SALDO_GOLS = "S";
    const DISCIPLINA = "D";
    
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=false)
     */
    private $edicao;    
    
    /**
     * @var Campeonato
     *
     * @ORM\ManyToOne(targetEntity="Campeonato", inversedBy="edicoes", nullable=false)
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="campeonato", referencedColumnName="id")
     * })
     */
    private $campeonato;

    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('F', 'M')", nullable=false)
     */
    private $categoria;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('T', 'C')", nullable=false)
     */
    private $tipo;

    
    /**
     * @var int
     *
     * Núemro de equipes inscritas
     * 
     * @ORM\Column(name="quantidade_equipes", type="integer", nullable=false)
     */
    private $quantidadeEquipes;
    
    /**
     * @var int
     *
     * Quantidade máxima de jogadores por equipe
     * 
     * @ORM\Column(name="quantidade_jogadores", type="integer", nullable=false)
     */
    private $quantidadeJogadores;
    
    /**
     * @var int
     *
     * Número de chaves do campeonato
     * 
     * @ORM\Column(name="quantidade_chaves", type="integer", nullable=true)
     */
    private $quantidadeChaves;
    
    /**
     * @var int
     *
     * Número de equipes classificadas por chave
     * 
     * @ORM\Column(name="quantidade_classificados_chaves", type="integer", nullable=true)
     */
    private $quantidadeClassificadosChave;


    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate1;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate2;
    
    /**
     *  @ORM\Column(type="string", columnDefinition="ENUM('V', 'S', 'D')", nullable=false)
     */
    private $desempate3;
    
    /**
     * @ORM\ManyToMany(targetEntity="Equipe", inverserBy="edicoesCampeonatos")
     * @ORM\JoinTable(name="edicao_campeonato_equipe",
     *      joinColumns={@ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id", unique=true)}
     * )
     */
    private $equipes;


    
    public function getLabel()
    {
        $this->campeonato->getNome()." - ";
    }

    
}
