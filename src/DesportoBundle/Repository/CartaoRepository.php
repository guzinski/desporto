<?php

namespace DesportoBundle\Repository;

use DesportoBundle\Entity\InscricaoProfissional;
use Doctrine\ORM\EntityRepository;

/**
 * Description of CartaoRepository
 *
 * @author Luciano
 */
class CartaoRepository extends EntityRepository
{
    
    /**
     * 
     * @param InscricaoProfissional $inscricao
     * @return array|null
     */
    public function getCartoesAmarelosSemSuspensaoPorInscricao(InscricaoProfissional $inscricao)
    {
        
        $query = $this->createQueryBuilder("C");
        $subQuery = $this->createQueryBuilder("C2");
        
        
        
        $query->andWhere($query->expr()->isNull("C.suspensao"))
                ->andWhere($query->expr()->eq("C.inscricao", ":inscricao"))
                ->andWhere($query->expr()->eq("C.cor", ":cor"))
                ->setParameter("inscricao", $inscricao->getId())
                ->setParameter("cor", \DesportoBundle\Entity\Cartao::AMARELO);
        
        $subQuery->select($subQuery->expr()->count("C2.id"))
                ->andWhere($subQuery->expr()->isNull("C2.suspensao"))
                ->andWhere($subQuery->expr()->eq("C2.inscricao", ":inscricao"))
                ->andWhere($subQuery->expr()->eq("C2.cor", ":cor"))
                ->setParameter("inscricao", $inscricao->getId())
                ->setParameter("cor", \DesportoBundle\Entity\Cartao::AMARELO);
        $query->select("C");
                
        
        $query->andWhere("3 = (".$subQuery->getDQL().")");
//        $query->setParameter("numero", 3);
        return $query->getQuery()->getResult();
    }
    
    
}
