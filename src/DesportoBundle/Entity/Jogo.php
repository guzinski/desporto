<?php

namespace DesportoBundle\Entity;

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
     * @var FaseClassificatoria
     *
     * @ORM\ManyToOne(targetEntity="FaseClassificatoria", inversedBy="jogos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="fase_classificatoria", referencedColumnName="id")
     * })
     */
    private $faseClassificatoria;
    
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
     * @var \DateTime
     *
     * @ORM\Column(type="date", nullable=true)
     */
    private $data;
    
    /**
     * @var \DateTime
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
    
    
    
    
}
