<?php

namespace DesportoBundle\Entity;

use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Validator\Constraints as Assert;


/**
 * Profissional
 *
 * @ORM\Table(name="equipe")
 * @UniqueEntity(
 *     fields={"nome", "dataExclusao"},
 *     ignoreNull=false,
 *     message="Já existe uma equipe cadatrada com este nome."
 * )
 * @ORM\Entity(repositoryClass="DesportoBundle\Repository\EquipeRepository")
 */
class Equipe extends BaseEntity
{
    
    /**
     * @var string
     * @Assert\NotBlank(message="Apelido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $apelido;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Nome da equipe deve ser preenchido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $nome;
    
    /**
     * @var string
     * @Assert\NotBlank(message="Nome do resposável deve ser preenchido")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $responsavel;

    /**
     * @var string
     * @Assert\NotBlank(message="Deve ser colocado um brasão para a equipe")
     * @ORM\Column(type="string", length=50, nullable=false)
     */
    private $brasao;

    /**
     * @var string
     * 
     * @ORM\Column(type="string", length=150, nullable=true)
     */
    private $endereco;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $telefone;

    /**
     * @ORM\ManyToMany(targetEntity="Arquivo", cascade={"all"})
     * @ORM\JoinTable(name="equipe_arquivo",
     *      joinColumns={@ORM\JoinColumn(name="equipe", referencedColumnName="id")},
     *      inverseJoinColumns={@ORM\JoinColumn(name="arquivo", referencedColumnName="id", unique=true)}
     * )
     */
    private $arquivos;
    
    /**
     * @var DateTime
     *
     * @ORM\Column(name="data_exclusao", type="datetime", nullable=true)
     */
    private $dataExclusao;
    
    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="equipesCadastradas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioCadastro;
    
    /**
     * @var Usuario
     *
     * @ORM\ManyToOne(targetEntity="Usuario", inversedBy="equipesExcluidas")
     * @ORM\JoinColumns({
     *   @ORM\JoinColumn(name="usuario", referencedColumnName="id")
     * })
     */
    private $usuarioExclusao;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="EdicaoCampeonato", mappedBy="equipes")
     **/
    private $edicoesCampeonatos;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="Chave", mappedBy="equipes")
     **/
    private $chaves;
    
    
    /**
     * @var Collection
     * @ORM\OneToMany(targetEntity="EdicaoCampeonatoEquipeProfissional", mappedBy="equipe")
     **/
    private $campeonatosProfissionais;
    
    /**
     * @var Collection
     * @ORM\ManyToMany(targetEntity="FaseClassificatoria", mappedBy="fasesClassificatorias")
     **/
    private $fasesClassificatorias;

    public function __construct()
    {
        parent::__construct();
        $this->setArquivos(new ArrayCollection());
        $this->setChaves(new ArrayCollection());
        $this->setFasesClassificatorias(new ArrayCollection());
        $this->setEdicoesCampeonatos(new ArrayCollection());
        $this->setCampeonatosProfissionais(new ArrayCollection());
    }

    
    public function getLabel()
    {
        return $this->nome." ".$this->id;
    }

    
    public function getNome()
    {
        return $this->nome;
    }


    public function getBrasao()
    {
        return $this->brasao;
    }

    public function getEndereco()
    {
        return $this->endereco;
    }

    public function getTelefone()
    {
        return $this->telefone;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;
        return $this;
    }


    public function setBrasao($brasao)
    {
        $this->brasao = $brasao;
        return $this;
    }

    public function setEndereco($endereco)
    {
        $this->endereco = $endereco;
        return $this;
    }

    public function setTelefone($telefone)
    {
        $this->telefone = $telefone;
        return $this;
    }

    public function getResponsavel()
    {
        return $this->responsavel;
    }

    public function getArquivos()
    {
        return $this->arquivos;
    }

    public function getDataExclusao()
    {
        return $this->dataExclusao;
    }


    public function setResponsavel($responsavel)
    {
        $this->responsavel = $responsavel;
        return $this;
    }

    public function setArquivos($arquivos)
    {
        $this->arquivos = $arquivos;
        return $this;
    }

    public function setDataExclusao(DateTime $dataExclusao)
    {
        $this->dataExclusao = $dataExclusao;
        return $this;
    }
    
    public function getUsuarioCadastro()
    {
        return $this->usuarioCadastro;
    }

    public function setUsuarioCadastro(Usuario $usuarioCadastro)
    {
        $this->usuarioCadastro = $usuarioCadastro;
        return $this;
    }

    public function getUsuarioExclusao()
    {
        return $this->usuarioExclusao;
    }

    public function setUsuarioExclusao(Usuario $usuarioExclusao)
    {
        $this->usuarioExclusao = $usuarioExclusao;
        return $this;
    }
    
    public function getApelido()
    {
        return $this->apelido;
    }

    public function setApelido($apelido)
    {
        $this->apelido = $apelido;
        return $this;
    }

    public function getEdicoesCampeonatos()
    {
        return $this->edicoesCampeonatos;
    }

    public function getChaves()
    {
        return $this->chaves;
    }

    public function setEdicoesCampeonatos(Collection $edicoesCampeonatos)
    {
        $this->edicoesCampeonatos = $edicoesCampeonatos;
        return $this;
    }

    public function setChaves(Collection $chaves)
    {
        $this->chaves = $chaves;
        return $this;
    }
    
    public function getFasesClassificatorias()
    {
        return $this->fasesClassificatorias;
    }

    public function setFasesClassificatorias(Collection $fasesClassificatorias)
    {
        $this->fasesClassificatorias = $fasesClassificatorias;
        return $this;
    }
    
    
    public function getCampeonatosProfissionais()
    {
        return $this->campeonatosProfissionais;
    }

    public function setCampeonatosProfissionais(Collection $campeonatosProfissionais)
    {
        $this->campeonatosProfissionais = $campeonatosProfissionais;
        return $this;
    }
    
    /**
     * 
     * @param \DesportoBundle\Entity\EdicaoCampeonato $campeonato
     * @return Profissional
     */
    public function getDiretor(EdicaoCampeonato $campeonato)
    {
        $query = \Doctrine\Common\Collections\Criteria::create();
        
        $query->andWhere($query->expr()->eq("edicaoCampeonato", $campeonato))
                ->andWhere($query->expr()->eq("tipo", EdicaoCampeonatoEquipeProfissional::DIRETOR));
        
        $collection = $this->campeonatosProfissionais->matching($query);
        if (!$collection->isEmpty()) {
            foreach ($collection as $row) {
                /** @var $row EdicaoCampeonatoEquipeProfissional  */
                return $row->getProfissional();
            }
        }
        return null;
    }
    
    /**
     * 
     * @param \DesportoBundle\Entity\EdicaoCampeonato $campeonato
     * @return Profissional
     */
    public function getTreinador(EdicaoCampeonato $campeonato)
    {
        $query = \Doctrine\Common\Collections\Criteria::create();
        
        $query->andWhere($query->expr()->eq("edicaoCampeonato", $campeonato))
                ->andWhere($query->expr()->eq("tipo", EdicaoCampeonatoEquipeProfissional::TREINADOR));
        
        $collection = $this->campeonatosProfissionais->matching($query);
        if (!$collection->isEmpty()) {
            foreach ($collection as $row) {
                /** @var $row EdicaoCampeonatoEquipeProfissional  */
                return $row->getProfissional();
            }
        }
        return null;
    }

    /**
     * 
     * @param \DesportoBundle\Entity\EdicaoCampeonato $campeonato
     * @return ArrayCollection
     */
    public function getJogadores(EdicaoCampeonato $campeonato)
    {
        $query = \Doctrine\Common\Collections\Criteria::create();
        
        $query->andWhere($query->expr()->eq("edicaoCampeonato", $campeonato))
                ->andWhere($query->expr()->eq("tipo", EdicaoCampeonatoEquipeProfissional::JOGADOR));
        
        return $this->campeonatosProfissionais->matching($query);
    }




}
