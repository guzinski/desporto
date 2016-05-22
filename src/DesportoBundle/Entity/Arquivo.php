<?php

namespace DesportoBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * Arquivo
 *
 * @ORM\Table(name="arquivo")
 * @UniqueEntity(fields={"nome"}, message="Já existe um documeno com esse nome cadastrado")
 * @ORM\Entity()
 */
class Arquivo extends BaseEntity
{
    /**
     * @var string
     *
     * @ORM\Column(type="string", length=150, nullable=false)
     */
    private $nome;    
    
    public function __construct($nome = NULL)
    {
        parent::__construct();
        if (!is_null($nome)) {
            $this->setNome($nome);
        }
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
    
    
    public function getLabel()
    {
        return $this->nome;
    }

    
}
