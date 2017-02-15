<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of GolRepository
 *
 * @author Luciano
 */
class GolRepository extends EntityRepository
{
    
    /**
     * 
     * @param \DesportoBundle\Entity\EdicaoCampeonato $campeonato
     * @return array
     */
    public function getGolsFromCampeonato(\DesportoBundle\Entity\EdicaoCampeonato $campeonato)
    {
        $query = $this->createQueryBuilder("G");
        $query->join("G.inscricao", "I")
                ->andWhere($query->expr()->eq("I.edicaoCampeonato", $campeonato->getId()));
        
        return $query->getQuery()->getResult();
    }
    
    
}
