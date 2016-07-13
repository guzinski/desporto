<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\EdicaoCampeonato;
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
        
    }
    
    /**
     * @param EdicaoCampeonato $campeonato
     */
    public function salvarChaves(EdicaoCampeonato $campeonato)
    {
        
    }
    
}
