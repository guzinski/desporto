<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Rodada;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManager;

/**
 * Description of EdicaoCampeonatoService
 *
 */
class EdicaoCampeonatoService
{

    /**
     * @var EntityManager 
     */
    protected $em;

    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarPontosCorridos(EdicaoCampeonato $campeonato)
    {
        
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarTorneio(EdicaoCampeonato $campeonato)
    {
        var_dump($campeonato);
        die();
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarChaves(EdicaoCampeonato $campeonato)
    {
        
    }
    
    
    
    
    private function gerarRodadas(Collection $equipes)
    {
        $rodadas = array();
        for ($i=1; $i>$equipes->count(); $i++) {
            
            foreach ($equipes as $equipe) {
                /* @var $equipe \DesportoBundle\Entity\Equipe */
                
                
            }
            
            $rodada = new Rodada();
            
            
            
        }
        
        
        
        
    }
    
}