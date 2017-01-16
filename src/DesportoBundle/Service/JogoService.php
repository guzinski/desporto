<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\Jogo;
use DesportoBundle\Repository\InscricaoProfissionalRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;

/**
 * Description of JogoService
 *
 * @author Luciano
 */
class JogoService
{
    
    /**
     *
     * @var EntityManager 
     */
    protected $em;
    
    public function __construct(EntityManager $em)
    {
        $this->em = $em;
    }
    
    
    /**
     * @param Jogo $param
     * @return Jogo jogo pronto para edição
     */
    public function getParaEdicao(Jogo $jogo)
    {
        if ($jogo->getProfissionalJogos()->count()>0) {
            return $jogo;
        } else {
            $inscricoes = $this->getRepositoryInscricaoProfissional()
                    ->getJogadoresPorJogo($jogo);

            foreach ($inscricoes as $inscricao) {
                $profissionalJogo = new \DesportoBundle\Entity\ProfissionalJogo($inscricao);
                $profissionalJogo->setJogo($jogo);
                $jogo->getProfissionalJogos()->add($profissionalJogo);
            }
            return $jogo;
        }
    }
    
    
    /**
     * @return EntityRepository 
     */
    protected function getRepository()
    {
        $this->em->getRepository(Jogo::class);
    }
    
    
    /**
     * @return InscricaoProfissionalRepository 
     */
    protected function getRepositoryInscricaoProfissional()
    {
        return $this->em->getRepository(\DesportoBundle\Entity\InscricaoProfissional::class);
    }
    
    


}
