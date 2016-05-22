<?php

namespace DesportoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of EquipeRepository
 *
 * @author Luciano
 */
class EquipeRepository extends EntityRepository
{
    
    /**
     * @param string $busca
     * @param int $maxResults
     * @param int $firstResult
     * @return array
     */
    public function getEquipes($busca, $maxResults, $firstResult)
    {
        $query = $this->createQueryBuilder("E");
        
        $query->select("E");
        if (!empty($busca)) {
            $query->andWhere($query->orWhere($query->expr()->like("E.nome", ":busca"))
                                    ->orWhere($query->expr()->like("E.responsavel", ":busca"))
                                    ->getDQLPart("where"));
            $query->setParameter("busca", "%{$busca}%");
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
        $query = $this->createQueryBuilder("E");
        
        $query->select("COUNT(E.id)");
        
        if (!empty($busca)) {
            $query->andWhere($query->orWhere($query->expr()->like("E.nome", ":busca"))
                                    ->orWhere($query->expr()->like("E.responsavel", ":busca"))
                                    ->getDQLPart("where"));
            $query->setParameter("busca", "%{$busca}%");
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }

    
}
