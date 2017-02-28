<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\Chave;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\Rodada;
use Doctrine\ORM\EntityRepository;

/**
 * Description of JogoRepository
 *
 */
class JogoRepository extends EntityRepository
{
    
    
    public function getjogosJogados(EdicaoCampeonato $campeonato, Chave $chave = null, Rodada $rodada = null, Equipe $equipe = null)
    {
        $query = $this->createQueryBuilder("J");
        
        $query->select("J, G, C")
                ->leftJoin("J.gols", "G")
                ->leftJoin("J.cartoes", "C")
                ->andWhere($query->expr()->eq("J.edicaoCampeonato", ":campeonato"))
                ->andWhere($query->expr()->eq("J.jogado", ":jogado"));
        if (!is_null($chave)) {
            $query->andWhere($query->expr()->eq("J.chave", ":chave"))
                    ->setParameter("chave", $chave->getId());
        }
        if (!is_null($rodada)) {
            $query->andWhere($query->expr()->eq("J.rodada", ":rodada"))
                    ->setParameter("rodada", $rodada->getId());
        }
        if (!is_null($equipe)) {
            $query->andWhere($query->expr()->orX(
                            $query->expr()->eq("J.equipeMandante", $equipe->getId()), $query->expr()->eq("J.equipeVisitante", $equipe->getId())
            ));
        }
        
        $query->setParameter("campeonato", $campeonato->getId());
        $query->setParameter("jogado", TRUE);
        
        return $query->getQuery()->getResult();
    }
    
    /**
     * 
     * @param EdicaoCampeonato $campeonato
     * @return int
     */
    public function countJogosNaoJogados(EdicaoCampeonato $campeonato)
    {
        $query = $this->createQueryBuilder("J");
        
        $query->select($query->expr()->count("J"))
                ->andWhere($query->expr()->eq("J.edicaoCampeonato", ":campeonato"))
                ->andWhere($query->expr()->eq("J.jogado", ":jogado"));
        
        $query->setParameter("campeonato", $campeonato->getId());
        $query->setParameter("jogado", FALSE);
        
        return $query->getQuery()->getSingleScalarResult();
    }
    
    
    
}
