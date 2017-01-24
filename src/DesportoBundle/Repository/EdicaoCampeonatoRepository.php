<?php

namespace DesportoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of EdicaoCampeonatoRepository
 *
 * @author Luciano
 */
class EdicaoCampeonatoRepository extends EntityRepository
{
    
    
    /**
     * @param string $busca
     * @param int $maxResults
     * @param int $firstResult
     * @return array
     */
    public function getCampeonatos($busca, $maxResults = 0, $firstResult = 0)
    {
        $query = $this->createQueryBuilder("EC");
        
        if (!empty($busca)) {
            $query->leftJoin("EC.campeonato", "C")
                    ->andWhere( $query->expr()->orX($query->expr()->like("C.nome", ":busca"), $query->expr()->like("EC.edicao", ":busca")))
                    ->setParameter("busca", "%{$busca}%");
        }
        
        if (($maxResults+$firstResult)>0) {
            $query->setFirstResult($firstResult)
                    ->setMaxResults($maxResults);
        }
                
        return $query->getQuery()->getResult();
    }
    
    
    /**
     * 
     * @return array
     */
    public function count($busca = "")
    {
        $query = $this->createQueryBuilder("EC");
        
        $query->select("COUNT(EC.id)");
        
        if (!empty($busca)) {
            $query->leftJoin("EC.campeonato", "C")
                    ->andWhere(
                            $query->expr()->orX($query->expr()->like("C.nome", ":busca"), $query->expr()->like("EC.edicao", ":busca"))
                            )
                    ->setParameter("busca", "%{$busca}%");
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }


    
}
