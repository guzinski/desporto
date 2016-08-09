<?php

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\EdicaoCampeonatoEquipeProfissional;
use Doctrine\ORM\EntityRepository;
use InvalidArgumentException;


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
    
    /**
     * 
     * @param int $idEquipe
     * @param int $idCampeonato
     * @return array
     * @throws InvalidArgumentException
     */
    public function getJogadoresInscritos($idEquipe, $idCampeonato)
    {
        if (empty($idEquipe) || empty($idCampeonato) || !is_numeric($idEquipe) || !is_numeric($idCampeonato)) {
            throw new InvalidArgumentException;
        }
        
        $query = $this->createQueryBuilder("J");
        
        return $query->select("J")
                ->join("J.campeoantosEquipes", "CE")
                ->andWhere($query->expr()->eq("CE.edicaoCampeonato", ":campeonato"))
                ->andWhere($query->expr()->eq("CE.equipe", ":equipe"))
                ->andWhere($query->expr()->eq("CE.tipo", ":tipo"))
                ->setParameter("campeonato", $idCampeonato)
                ->setParameter("equipe", $idEquipe)
                ->setParameter("tipo", EdicaoCampeonatoEquipeProfissional::JOGADOR)
                ->getQuery()
                ->getResult();        
    }
    
    /**
     * 
     * @param int $idCampeonato
     * @param int $idEquipe
     * @param string $busca
     * @return array
     * @throws InvalidArgumentException
     */
    public function getJogadoresDisponíveis($idCampeonato, $idEquipe, $busca = null)
    {
        if (empty($idCampeonato) || !is_numeric($idCampeonato)) {
            throw new InvalidArgumentException;
        }
        
        $query = $this->createQueryBuilder("J");
        
        if (!empty($busca)) {
            $query->andWhere(
                    $query->expr()->orX(
                            $query->expr()->like("J.nome", ":busca"), $query->expr()->like("J.cpf", ":busca")
                    )
            );
        }
        return $query->select("J")
                ->leftJoin("J.campeoantosEquipes", "CE")
                ->andWhere(
                    $query->expr()->orX(
                            $query->expr()->orX(
                                $query->expr()->neq("CE.edicaoCampeonato", ":campeonato"),
                                $query->expr()->isNull("CE.edicaoCampeonato")
                            ),
                            $query->expr()->andX(
                                    $query->expr()->eq("CE.edicaoCampeonato", ":campeonato"),
                                    $query->expr()->eq("CE.equipe", ":equipe"),
                                    $query->expr()->neq("CE.tipo", ":tipo")
                                )
                            )
                    )
                ->setParameter("campeonato", $idCampeonato)
                ->setParameter("equipe", $idEquipe)
                ->setParameter("tipo", EdicaoCampeonatoEquipeProfissional::JOGADOR)
                ->setParameter("busca", "%{$busca}%")
                ->addOrderBy("J.nome")
                ->setMaxResults(100)
                ->getQuery()
                ->getResult();
    }
        


    
}
