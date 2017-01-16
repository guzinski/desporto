<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Form\JogoType;
use DesportoBundle\Service\JogoService;
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

        $inscricoes = $this->getDoctrine()->getRepository(InscricaoProfissional::class)
                ->getJogadoresPorJogo($jogo);

        $jogo = $this->getJogoService()->getParaEdicao($jogo);
        $form = $this->createForm(JogoType::class, $jogo, ['inscricoes'=>$inscricoes]);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $jogo->setJogado(TRUE);
            $this->getDoctrine()->getManager()->persist($jogo);
            $this->getDoctrine()->getManager()->flush();
            return new RedirectResponse($this->generateUrl('campeonato_detalhe', array('campeonato' => $jogo->getEdicaoCampeonato()->getId())));
        }

        return ['form' => $form->createView(), 'jogo' => $jogo];
    }

    /**
     * 
     * @return JogoService
     */
    protected function getJogoService()
    {
        return $this->get("jogo");
    }

}
