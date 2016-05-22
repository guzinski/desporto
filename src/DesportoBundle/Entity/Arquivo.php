<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Arquivo
 *
 * @ORM\Table(name="arquivo")
 * @ORM\Entity()
 */
class Arquivo
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
     * @var string
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;    
    
    /**
     * @var Profissional
     *
     * @ORM\ManyToOne(targetEntity="Profissional", inversedBy="arquivos")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="profissional", referencedColumnName="id")
     * })
     */
    private $profissional;
    
    public function __construct($nome = NULL, $cliente = NULL)
    {
        if (!is_null($nome)) {
            $this->setNome($nome);
        }
        if (!is_null($cliente)) {
            $this->setCliente($cliente);
        }
    }
    
    public function getId()
    {
        return $this->id;
    }

    public function getNome()
    {
        return $this->nome;
    }


    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }

    public function getProfissional()
    {
        return $this->profissional;
    }

    public function setProfissional(Profissional $profissional)
    {
        $this->profissional = $profissional;
        return $this;
    }


    
    
    
}
