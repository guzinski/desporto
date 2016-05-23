<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Description of Chave
 *
 * @author Luciano
 */
class Chave extends BaseEntity
{
    
    /**
     * @var EdicaoCampeonato
     *
     * @ORM\ManyToOne(targetEntity="EdicaoCampeonato", inversedBy="chaves")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="edicao_campeonato", referencedColumnName="id")
     * })
     */
    private $usuario;
    
    
    /**
     * @ORM\ManyToMany(targetEntity="Equipe", inverserBy="chaves")
     * @ORM\JoinTable(name="chave_equipe",
     *      joinColumns={@ORM\JoinColumn(name="chave", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id", unique=true)}
     * )
     */
    private $equipes;
    
    /**
     * @var int
     *
     * Número da chave
     * 
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numero;

    
}
