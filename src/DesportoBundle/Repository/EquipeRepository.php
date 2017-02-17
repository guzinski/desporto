<?php

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\Gol;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr\Join;

/**
 * Description of EquipeRepository
 *
 * @author Luciano
 */
class EquipeRepository extends EntityRepository
{
    
    
    /**
     * Retorna a qauntidade total de gols feitos pela Equipe
     * 
     * @param Equipe $equipe
     * @return int
     */
    public function getTotalGolsEquipe(Equipe $equipe)
    {
        $query = $this->getEntityManager()->createQueryBuilder();        
        $query->select($query->expr()->count("G"))
                ->from(Gol::class, "G")
                ->leftJoin("G.inscricao", "I")
                ->andWhere($query->expr()->eq("I.equipe", $equipe->getId()));
        
        return $query->getQuery()->getSingleScalarResult();
    }
    
    /**
     * Retorna a qauntidade total de cartões feitos pela Equipe
     * 
     * @param Equipe $equipe
     * @param string $cor
     * @return int
     */
    public function getTotalCartoesEquipe(Equipe $equipe, $cor = null)
    {
        $query = $this->getEntityManager()->createQueryBuilder();        
        $query->select($query->expr()->count("C"))
                ->from(\DesportoBundle\Entity\Cartao::class, "C")
                ->leftJoin("C.inscricao", "I")
                ->andWhere($query->expr()->eq("I.equipe", $equipe->getId()));
        
        if (!is_null($cor)) {
            $query->andWhere($query->expr()->eq("C.cor", ":cor"))
                    ->setParameter("cor", $cor);
        }
        
        return $query->getQuery()->getSingleScalarResult();
    }

    
    /**
     * @param string $busca
     * @param int $maxResults
     * @param int $firstResult
     * @return array
     */
    public function getEquipes($busca, $maxResults = 0, $firstResult = 0)
    {
        $query = $this->createQueryBuilder("E");
        
        $query->select("E");
        if (!empty($busca)) {
            $query->andWhere($query->orWhere($query->expr()->like("E.nome", ":busca"))
                                    ->orWhere($query->expr()->like("E.apelido", ":busca"))
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
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @param boolean $inscricoes Se TRUE carrega as inscrições de cada equipe
     */
    public function getEquipesCampeonato(EdicaoCampeonato $campeonato, $inscricoes = FALSE)
    {
        $queri = $this->createQueryBuilder("E");
        if ($inscricoes) {
            $queri->select("E, I, P");
            $queri->leftJoin("E.inscricoes", "I", Join::WITH, "I.edicaoCampeonato = :campeonato");
            $queri->leftJoin("I.profissional", "P");
        }
        $queri->innerJoin("E.edicoesCampeonatos", "EC", Join::WITH, "EC.id = :campeonato");
        $queri->andWhere($queri->expr()->eq("EC.id", ":campeonato"))
                ->setParameter("campeonato", $campeonato->getId());
        
        return $queri->getQuery()->getResult();
    }

    
}
