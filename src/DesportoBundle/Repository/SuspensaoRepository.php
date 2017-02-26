<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Description of SuspensaoRepository
 *
 * @author Luciano
 */
class SuspensaoRepository extends EntityRepository
{
    
    public function getJulgamentos($julgada = FALSE, $busca = "", $firstResult = 0, $maxResults = 0)
    {
        $query = $this->createQueryBuilder("S");
        $query->select("S, I, E, P, EC, C")
                ->leftJoin("S.inscricao", "I")
                ->leftJoin("I.equipe", "E")
                ->leftJoin("I.profissional", "P")
                ->leftJoin("I.edicaoCampeonato", "EC")
                ->leftJoin("EC.campeonato", "C")
                ->andWhere($query->expr()->eq("S.julgamento", TRUE));
        
        if ($julgada) {
            $query->andWhere($query->expr()->eq("S.julgada", TRUE));
        } else {
            $query->andWhere($query->expr()->orX(
                    $query->expr()->eq("S.julgada", $query->expr()->literal(FALSE)),
                    $query->expr()->isNull("S.julgada")
            ));
        }
        
        
        if (!empty($busca)) {
                $query->andWhere($query->expr()->orX(
                        $query->expr()->like("E.nome", ":busca"),
                        $query->expr()->like("C.nome", ":busca"),
                        $query->expr()->like("EC.edicao", ":busca"),
                        $query->expr()->like("P.nome", ":busca")
                ))
                ->setParameter("busca", $busca);
        }
        
        
        if (($maxResults+$firstResult)>0) {
            $query->setFirstResult($firstResult)
                    ->setMaxResults($maxResults);
        }

        return $query->getQuery()->getResult();
    }

    /**
     * 
     * @param type $julgada
     * @param type $busca
     * @return type
     */
    public function count($julgada = FALSE, $busca = "")
    {
        $query = $this->createQueryBuilder("S");
        $query->select($query->expr()->count("S.id"))
                ->leftJoin("S.inscricao", "I")
                ->leftJoin("I.equipe", "E")
                ->leftJoin("I.profissional", "P")
                ->leftJoin("I.edicaoCampeonato", "EC")
                ->leftJoin("EC.campeonato", "C")
                ->andWhere($query->expr()->eq("S.julgamento", TRUE));
        if ($julgada) {
            $query->andWhere($query->expr()->eq("S.julgada", TRUE));
        } else {
            $query->andWhere($query->expr()->orX(
                    $query->expr()->eq("S.julgada", $query->expr()->literal(FALSE)),
                    $query->expr()->isNull("S.julgada")
            ));
        }
        
        if (!empty($busca)) {
                $query->andWhere($query->expr()->orX(
                        $query->expr()->like("E.nome", ":busca"),
                        $query->expr()->like("C.nome", ":busca"),
                        $query->expr()->like("EC.edicao", ":busca"),
                        $query->expr()->like("P.nome", ":busca")
                ))
                ->setParameter("busca", $busca);
        }

        return $query->getQuery()->getSingleScalarResult();
    }
    
    
    
}
