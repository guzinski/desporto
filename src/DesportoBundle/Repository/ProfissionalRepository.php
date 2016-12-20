<?php

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\InscricaoProfissional;
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
     * @param int $campeonato
     * @return array
     * @throws InvalidArgumentException
     */
    public function getJogadoresInscritos(EdicaoCampeonato $campeonato, $idEquipe)
    {
        if (is_null($campeonato) || empty($idEquipe) || !is_numeric($idEquipe)) {
            throw new InvalidArgumentException;
        }
        
        $query = $this->createQueryBuilder("J");
        
        return $query->select("J")
                ->join("J.campeoantosEquipes", "CE")
                ->andWhere($query->expr()->eq("CE.edicaoCampeonato", ":campeonato"))
                ->andWhere($query->expr()->eq("CE.equipe", ":equipe"))
                ->andWhere($query->expr()->eq("CE.tipo", ":tipo"))
                ->setParameter("campeonato", $campeonato->getId())
                ->setParameter("equipe", $idEquipe)
                ->setParameter("tipo", InscricaoProfissional::JOGADOR)
                ->getQuery()
                ->getResult();        
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @param int $idEquipe
     * @param string $busca
     * @param array $inscritos
     * @return array
     */
    public function getJogadoresDisponíveis(EdicaoCampeonato $campeonato, $idEquipe, $busca = null, $inscritos = null)
    {
        return $this->getProfissionaisDisponideis($campeonato, InscricaoProfissional::JOGADOR, $idEquipe, $busca, $inscritos, $campeonato->getModalidade());
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @param int $idEquipe
     * @param string $busca
     * @return array
     */
    public function getDiretoresDisponíveis(EdicaoCampeonato $campeonato, $idEquipe, $busca = null)
    {
        return $this->getProfissionaisDisponideis($campeonato, InscricaoProfissional::DIRETOR, $idEquipe, $busca);
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @param int $idEquipe
     * @param string $busca
     * @return array
     */
    public function getTreinadoresDisponíveis(EdicaoCampeonato $campeonato, $idEquipe, $busca = null)
    {
        return $this->getProfissionaisDisponideis($campeonato, InscricaoProfissional::TREINADOR, $idEquipe, $busca);
    }

    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @param string $tipo
     * @param int $idEquipe
     * @param string $busca
     * @param array $inscritos
     * @param string $sexo
     * @return array
     * @throws InvalidArgumentException
     */
    private function getProfissionaisDisponideis(EdicaoCampeonato $campeonato, $tipo, $idEquipe, $busca = null, $inscritos = null, $sexo = null)
    {
        if (empty($campeonato) || empty($tipo) || empty($idEquipe)) {
            throw new InvalidArgumentException;
        }

        $query = $this->createQueryBuilder("J");

        $subQuery = $this->createQueryBuilder("J2");

        $subQuery->innerJoin("J2.campeoantosEquipes", "CE")
                ->orWhere(
                        $subQuery->expr()->andX(
                                $subQuery->expr()->eq("CE.edicaoCampeonato", ":campeonato"), $subQuery->expr()->eq("CE.tipo", ":tipo")
                        )
                )
                ->orWhere(
                        $subQuery->expr()->andX(
                                $subQuery->expr()->eq("CE.edicaoCampeonato", ":campeonato"), $subQuery->expr()->neq("CE.equipe", ":equipe")
                        )
        );

        //String de busca do nome do Jogador
        if (!empty($busca)) {
            $query->andWhere(
                    $query->expr()->orX(
                            $query->expr()->like("J.nome", ":busca"), $query->expr()->like("J.cpf", ":busca")
                    )
            );
        }
        
        //Retira os jogadores que já estão inscritos
        if (!empty($inscritos)) {
            $clausule = array();
            foreach ($inscritos as $inscrito) {
                $clausule[] = $inscrito['value'];
            }
            $query->andWhere($query->expr()->notIn("J.id", $clausule));
        }
        
        if (!is_null($sexo)) {
            $query->andWhere($query->expr()->eq("J.sexo", ":sexo"))
                    ->setParameter("sexo", $sexo);
        }
        
        return $query->select("J")
                        ->andWhere($query->expr()->notIn("J.id", $subQuery->getDQL()))
                        
                        ->setParameter("campeonato", $campeonato->getId())
                        
                        ->setParameter("equipe", $idEquipe)
                        ->setParameter("tipo", $tipo)
                        ->setParameter("busca", "%{$busca}%")
                        ->addOrderBy("J.nome")
                        ->setMaxResults(10)
                        ->getQuery()
                        ->getResult();
    }

    
}
