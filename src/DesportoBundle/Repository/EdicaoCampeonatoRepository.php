<?php

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\EdicaoCampeonato;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\NoResultException;

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
    public function getCampeonatos($busca, $maxResults = 0, $firstResult = 0, $encerrados = 0)
    {
        $query = $this->createQueryBuilder("EC");
        
        if ($encerrados) {
            $query->andWhere($query->expr()->eq("EC.status", ":status"))
                ->setParameter("status", EdicaoCampeonato::ENCERRADO);
        } else {
            $query->andWhere($query->expr()->neq("EC.status", ":status"))
                ->setParameter("status", EdicaoCampeonato::ENCERRADO);
        }
        
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
    public function count($encerrados = 0, $busca = "")
    {
        $query = $this->createQueryBuilder("EC");
        
        $query->select("COUNT(EC.id)");
        
        if ($encerrados) {
            $query->andWhere($query->expr()->eq("EC.status", ":status"))
                ->setParameter("status", EdicaoCampeonato::ENCERRADO);
        } else {
            $query->andWhere($query->expr()->neq("EC.status", ":status"))
                ->setParameter("status", EdicaoCampeonato::ENCERRADO);
        }

        
        if (!empty($busca)) {
            $query->leftJoin("EC.campeonato", "C")
                    ->andWhere(
                            $query->expr()->orX($query->expr()->like("C.nome", ":busca"), $query->expr()->like("EC.edicao", ":busca"))
                            )
                    ->setParameter("busca", "%{$busca}%");
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }
    
    public function carregaCampeonatoComJogos(EdicaoCampeonato $campeonato)
    {
        $query = $this->createQueryBuilder("EC");
        $query->select("EC, R, J, G, C")
                ->leftJoin("EC.rodadas", "R")
                ->leftJoin("EC.jogos", "J")
                ->leftJoin("J.gols", "G")
                ->leftJoin("J.cartoes", "C")
                ->andWhere($query->expr()->eq("EC.id", $campeonato->getId()));
                
                
        try {
            return $query->getQuery()->getSingleResult();
        } catch (NoResultException $exc) {
            return null;
        }
    }


    
}
