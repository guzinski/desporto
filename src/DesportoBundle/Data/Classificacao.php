<?php


namespace DesportoBundle\Data;

use DesportoBundle\Entity\Equipe;

/**
 * Description of Classificaocao
 *
 * @author Luciano
 */
class Classificacao
{
    
    /**
     * @var Equipe
     */
    private $equipe;

    private $vitorias = 0;
    private $empates = 0;
    private $derrotas = 0;
    private $cartoesAmarelos  = 0;
    private $cartoesVermelhos  = 0;
    private $golsMarcados = 0;
    private $golsSofridos  = 0;
    
    
    public function __construct(Equipe $equipe)
    {
        $this->equipe = $equipe;
    }

    
    public function getEquipe()
    {
        return $this->equipe;
    }

    public function getPontos()
    {
        return $this->pontos = $this->vitorias * 3 + $this->empates;
    }

    public function getVitorias()
    {
        return $this->vitorias;
    }

    public function getEmpates()
    {
        return $this->empates;
    }

    public function getDerrotas()
    {
        return $this->derrotas;
    }

    public function getCartoesAmarelos()
    {
        return $this->cartoesAmarelos;
    }

    public function getCartoesVermelhos()
    {
        return $this->cartoesVermelhos;
    }

    public function getGolsMarcados()
    {
        return $this->golsMarcados;
    }

    public function getGolsSofridos()
    {
        return $this->golsSofridos;
    }

    public function getGolsSaldo()
    {
        return $this->golsSaldo = $this->golsMarcados-$this->getGolsSofridos();
    }

    public function setEquipe(Equipe $equipe)
    {
        $this->equipe = $equipe;
        return $this;
    }

    public function setVitorias($vitorias)
    {
        $this->vitorias = $vitorias;
        return $this;
    }

    public function setEmpates($empates)
    {
        $this->empates = $empates;
        return $this;
    }

    public function setDerrotas($derrotas)
    {
        $this->derrotas = $derrotas;
        return $this;
    }

    public function setCartoesAmarelos($cartoesAmarelos)
    {
        $this->cartoesAmarelos = $cartoesAmarelos;
        return $this;
    }

    public function setCartoesVermelhos($cartoesVermelhos)
    {
        $this->cartoesVermelhos = $cartoesVermelhos;
        return $this;
    }

    public function setGolsMarcados($golsMarcados)
    {
        $this->golsMarcados = $golsMarcados;
        return $this;
    }

    public function setGolsSofridos($golsSofridos)
    {
        $this->golsSofridos = $golsSofridos;
        return $this;
    }

    public function addVitoria()
    {
        $this->vitorias++;
    }

    public function addEmpate()
    {
        $this->empates++;
    }

    public function addDerrota()
    {
        $this->derrotas++;
    }

    public function addCartaoAmarelo($valor)
    {
        $this->cartoesAmarelos =+ $valor;
    }

    public function addCartaoVermelho($valor)
    {
        $this->cartoesVermelhos =+ $valor;
    }

    public function addGolsMarcados($valor)
    {
        $this->golsMarcados += $valor;
    }

    public function addGolsSofridos($valor)
    {
        $this->golsSofridos += $valor;
    }
    
    public function getAproveitamento()
    {
        if ($this->getTotalJogos() == 0) {
            return 0;
        }
        return $this->getPontos() / ($this->getTotalJogos() *3) * 100;
    }
    
    public function getTotalJogos()
    {
        return $this->vitorias+$this->empates+$this->derrotas;
    }
    
    
    
}
