<?php

namespace DesportoBundle\Repository;

use Doctrine\ORM\EntityRepository;
use Symfony\Component\HttpFoundation\Request;


/**
 * Description of ProfissionalRepository
 *
 * @author Luciano
 */
class ProfissionalRepository extends EntityRepository
{
    
    
    /**
     * 
     * @param string $busca
     * @param int $maxResults
     * @param int $firstResult
     * @return array
     */
    public function getProfissionais($busca, $maxResults, $firstResult)
    {
        $query = $this->createQueryBuilder("P");
        
        $query->select("P");
        if (!empty($busca)) {
            $query->andWhere($query->orWhere($query->expr()->like("P.nome", ":busca"))
                                    ->orWhere($query->expr()->like("P.cpf", ":busca"))
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
        $query = $this->createQueryBuilder("P");
        
        $query->select("COUNT(P.id)");
        
        if (!empty($busca)) {
            $query->andWhere($query->orWhere($query->expr()->like("P.nome", ":busca"))
                                    ->orWhere($query->expr()->like("P.cpf", ":busca"))
                                    ->getDQLPart("where"));
            $query->setParameter("busca", "%{$busca}%");
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }
    
    
    /**
     * @param string $param
     * @return array
     */
    public function uniqueEntity($param) 
    {
        if (isset ($param['cpf'])) {
            if (empty($param['cpf'])) {
                return array();;
            } else {
                return $this->findBy($param);
            }
        }
        return array();;
    }
        


    
}
