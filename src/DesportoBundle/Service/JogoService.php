<?php

namespace DesportoBundle\Service;

use DesportoBundle\Entity\Cartao;
use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Entity\ProfissionalJogo;
use DesportoBundle\Entity\Suspensao;
use DesportoBundle\Repository\InscricaoProfissionalRepository;
use Doctrine\Common\Collections\ArrayCollection;
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
            $this->verificaSuspensao($jogo);
            return $jogo;
        } else {
            $inscricoes = $this->getRepositoryInscricaoProfissional()
                    ->getJogadoresPorJogo($jogo);

            foreach ($inscricoes as $inscricao) {
                $profissionalJogo = new ProfissionalJogo($inscricao);
                $profissionalJogo->setJogo($jogo);
                $jogo->getProfissionalJogos()->add($profissionalJogo);
            }
            $this->verificaSuspensao($jogo);
            return $jogo;
        }
    }
    
    
    private function verificaSuspensao(Jogo $jogo)
    {
        $hoje = new \DateTime("now");
        if (!$jogo->getJogado()) {
            foreach ($jogo->getProfissionalJogos() as $profissionalJogo) {
                /* @var $profissionalJogo ProfissionalJogo */
                foreach ($profissionalJogo->getInscricao()->getSuspensoes() as $suspensao) {
                    /* @var $suspensao Suspensao */    
                    if ($suspensao->getQuantidadeJogos() > $suspensao->getJogosCumpridos()->count() || (!is_null($suspensao->getData()) && $suspensao->getData() > $hoje) ) {
                        if ($jogo->getProfissionalJogos()->contains($profissionalJogo)) {
                            $jogo->getProfissionalJogos()->removeElement($profissionalJogo);
                            $suspensao->getJogosCumpridos()->add($jogo);
                            $jogo->getSuspensoes()->add($suspensao);
                            break;
                        }
                    }
                }
            }
        } 
        
    }
    
    public function aplicarSuspensao(Jogo $jogo)
    {
        $cartoes = $jogo->getCartoes()->filter(function (Cartao $cartao) {
            return is_null($cartao->getSuspensao());
        });
        
        /**
         * Lista Cartões Vemelhos
         */
        foreach ($cartoes as $cartao) {
            /* @var $cartao Cartao */
            if ($cartao->getCor() == Cartao::VERMELHO) {
                $suspensao = new Suspensao();
                $inscricao = $cartao->getInscricao();
                $cartoesRecebidos = $cartoes->filter(function(Cartao $cartao) use ($inscricao) {
                    return $cartao->getInscricao() == $inscricao && $cartao->getCor() == Cartao::AMARELO;
                });
                //Se for expulso COm dois amarelos não vai a julgamento e Os amarelos não contam para suspensões
                if ($cartoesRecebidos->count() == 2) {
                    $cartoesRecebidos->add($cartao);
                    foreach ($cartoesRecebidos as $cartaoRecebido) {
                        $cartoes->removeElement($cartaoRecebido);
                        $suspensao->addCartao($cartaoRecebido);
                    }
                } else {
                    $cartoes->removeElement($cartao);
                    $suspensao->addCartao($cartao);
                    $suspensao->setJulgamento(TRUE);
                }
                $suspensao->setQuantidadeJogos(1);
                $suspensao->setInscricao($cartao->getInscricao());
                $this->em->persist($suspensao);
            }
        }
        
        /**
         * Lista Cartões Vemelhos
         */
        foreach ($cartoes as $cartao) {
            /* @var $cartao Cartao */
            if ($cartao->getCor() == Cartao::AMARELO) {
                /* Busca Cartões amarelos da Inscrição que não tenha uma suspensão aplicada*/
                $cartoesAmarelos = $this->em->getRepository(Cartao::class)->getCartoesAmarelosSemSuspensaoPorInscricao($cartao->getInscricao());
                /* Aplica as suspensões por cartão Amarelos*/
                if (!empty($cartoesAmarelos)) {
                    $suspensao = new Suspensao();
                    foreach ($cartoesAmarelos as $cartaoAmarelo) {
                        $suspensao->addCartao($cartaoAmarelo);
                    }
                    $suspensao->setQuantidadeJogos(1);
                    $suspensao->setInscricao($cartao->getInscricao());
                    $this->em->persist($suspensao);
                }
            }
        }
        
        $this->em->flush();
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
        return $this->em->getRepository(InscricaoProfissional::class);
    }
    
    


}
