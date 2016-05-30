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
     * número da chave
     * @var int
     *
     * @ORM\Column(type="integer", nullable=false)
     */
    private $numero;
    
    public function getId()
    {
        return $this->id;
    }
    
    public function getLabel()
    {
        return $this->getNumero();
    }


    public function getUsuario()
    {
        return $this->usuario;
    }

    public function getEquipes()
    {
        return $this->equipes;
    }

    public function getNumero()
    {
        return $this->numero;
    }

    public function setUsuario(EdicaoCampeonato $usuario)
    {
        $this->usuario = $usuario;
        return $this;
    }

    public function setEquipes($equipes)
    {
        $this->equipes = $equipes;
        return $this;
    }

    public function setNumero($numero)
    {
        $this->numero = $numero;
        return $this;
    }


    
    
}
