<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\Jogo;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityRepository;

/**
 * Description of InscricaoProfissionalRepository
 *
 * @author Luciano
 */
class InscricaoProfissionalRepository extends EntityRepository
{

    /**
     * 
     * @param Jogo $jogo
     * @return Collection
     */
    public function getJogadoresPorJogo(Jogo $jogo)
    {
        $query = $this->createQueryBuilder("IP");
        $query->leftJoin("IP.suspensoes", "S", \Doctrine\ORM\Query\Expr\Join::ON)
                ->andWhere($query->expr()->eq("IP.tipo", $query->expr()->literal(InscricaoProfissional::JOGADOR)))
                ->andWhere($query->expr()->eq("IP.edicaoCampeonato", $jogo->getEdicaoCampeonato()->getId()))
                ->andWhere(
                        $query->expr()->orX(
                                $query->expr()->eq("IP.equipe", $jogo->getEquipeMandante()->getId()), $query->expr()->eq("IP.equipe", $jogo->getEquipeVisitante()->getId())
        ));

        return $query->getQuery()->getResult();
    }

}
