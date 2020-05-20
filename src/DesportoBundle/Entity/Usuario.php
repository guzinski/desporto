<?php

namespace DesportoBundle\Entity;

use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * Usuario
 *
 * @ORM\Table(name="usuario")
 * @ORM\Entity
 */
class Usuario extends BaseEntity implements UserInterface
{
    /**
     * @var string
     *
     * @ORM\Column(name="nome", type="string", length=100, nullable=false)
     */
    private $nome;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="senha", type="string", length=150, nullable=false)
     */
    private $senha;
    
    /**
     * @var Nivel
     *
     * @ORM\ManyToOne(targetEntity="Nivel", inversedBy="usuarios")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="nivel", referencedColumnName="id")
     * })
     */
    private $nivel;

    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Equipe", mappedBy="usuarioCadastro")
     **/
    private $equipesCadastradas = null;
    
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Equipe", mappedBy="usuarioExclusao")
     **/
    private $equipesExcluidas = null;
    
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Profissional", mappedBy="usuarioCadastro")
     **/
    private $profissionaisCadastradas = null;
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="Profissional", mappedBy="usuarioExclusao")
     **/
    private $profissionaisExcluidas = null;

    /**
     * Set nome
     *
     * @param string $nome
     * @return Usuario
     */
    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    /**
     * Get nome
     *
     * @return string 
     */
    public function getNome()
    {
        return $this->nome;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return Usuario
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set senha
     *
     * @param string $senha
     * @return Usuario
     */
    public function setSenha($senha)
    {
        $this->senha = $senha;

        return $this;
    }

    /**
     * Get senha
     *
     * @return string 
     */
    public function getSenha()
    {
        return $this->senha;
    }
    
    public function eraseCredentials()
    {
        
    }

    /**
     * 
     * @return string
     */
    public function getPassword()
    {
        return $this->getSenha();
    }

    /**
     * 
     * @return array
     */
    public function getRoles()
    {
        return $this->getNivel()->getRoles();
    }

    /**
     * 
     * @return string
     */
    public function getSalt()
    {
        return null;
    }

    /**
     * 
     * @return string
     */
    public function getUsername()
    {
        return $this->getEmail();
    }
    
    /**
     * 
     * @return Nivel
     */
    public function getNivel()
    {
        return $this->nivel;
    }

    public function setNivel(Nivel $nivel)
    {
        $this->nivel = $nivel;
        return $this;
    }
    
    public function getLabel()
    {
        return $this->nome;
    }

    
    public function getEquipesCadastradas()
    {
        return $this->equipesCadastradas;
    }

    public function getEquipesExcluidas()
    {
        return $this->equipesExcluidas;
    }

    public function getProfissionaisCadastradas()
    {
        return $this->profissionaisCadastradas;
    }

    public function getProfissionaisExcluidas()
    {
        return $this->profissionaisExcluidas;
    }

    public function setEquipesCadastradas(Collection $equipesCadastradas)
    {
        $this->equipesCadastradas = $equipesCadastradas;
        return $this;
    }

    public function setEquipesExcluidas(Collection $equipesExcluidas)
    {
        $this->equipesExcluidas = $equipesExcluidas;
        return $this;
    }

    public function setProfissionaisCadastradas(Collection $profissionaisCadastradas)
    {
        $this->profissionaisCadastradas = $profissionaisCadastradas;
        return $this;
    }

    public function setProfissionaisExcluidas(Collection $profissionaisExcluidas)
    {
        $this->profissionaisExcluidas = $profissionaisExcluidas;
        return $this;
    }






}
