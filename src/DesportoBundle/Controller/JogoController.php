<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Jogo;
use DesportoBundle\Form\JogoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of JogoController
 * @Route("/jogo")
 * @author Luciano
 */
class JogoController extends Controller
{
        
    /**
     * 
     * @Route("/{jogo}", name="jogo_detalhar")
     * @Template()
     * @param Jogo $jogo
     */
    public function detalharAction(Jogo $jogo, Request $request) 
    {
        
        $inscricoes = $this->getDoctrine()->getRepository(\DesportoBundle\Entity\InscricaoProfissional::class)
                ->getJogadoresPorJogo($jogo);
        
        foreach ($inscricoes as $inscricao) {
            $profissionalJogo = new \DesportoBundle\Entity\ProfissionalJogo($inscricao);
            $profissionalJogo->setJogo($jogo);
            $jogo->getProfissionalJogos()->add($profissionalJogo);
        }
        
        $form = $this->createForm(JogoType::class, $jogo);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            $this->getDoctrine()->getManager()->persist($jogo);
            return new RedirectResponse($this->generateUrl('campeonato_detalhe', array('campeonato'=>$jogo->getEdicaoCampeonato()->getId())));
        }
        return ['form'=>$form->createView(), 'jogo'=>$jogo];
    }
    
    
}
