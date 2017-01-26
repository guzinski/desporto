<?php

namespace DesportoBundle\Controller;

use DateTime;
use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\Jogo;
use DesportoBundle\Form\JogoType;
use DesportoBundle\Service\JogoService;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

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
     * @Route("/form/definir/data", name="jogo_form_definir_data")
     * @Template()
     */
    public function formDefinirDataAction(Request $request)
    {
        $jogo = $request->get("jogo");
        if (empty($jogo)) {
            throw new InvalidArgumentException;
        }
        $jogo = $this->getDoctrine()->getRepository(Jogo::class)->find($jogo);
        if (empty($jogo)) {
            throw new NotFoundHttpException;
        }

        return ['hoje' => new DateTime("now"), 'jogo' => $jogo];
    }
    
    /**
     * @Route("/salvar/definir/data", name="jogo_salvar_definir_data")
     */
    public function salvarDefinirDataAction(Request $request)
    {
        $jogo       = $request->get("jogo");
        $data       = $request->get("data");
        $horario    = $request->get("horario");
        if (empty($jogo) || empty($data) || empty($horario)) {
            throw new InvalidArgumentException;
        }
        $jogo = $this->getDoctrine()->getRepository(Jogo::class)->find($jogo);
        if (empty($jogo)) {
            throw new NotFoundHttpException;
        }
        
        try {
            $data = DateTime::createFromFormat("d/m/Y", $data);
            $horario = DateTime::createFromFormat("H:i", $horario);
        } catch (Exception $ex) {
            throw new InvalidArgumentException;
        }
        
        $jogo->setData($data);
        $jogo->setHorario($horario);
        
        $this->getDoctrine()->getManager()->persist($jogo);
        $this->getDoctrine()->getManager()->flush();
        
        return new Response();
    }

    
    /**
     * @Route("/form/definir/local", name="campeonato_form_definir_local")
     * @Template()
     */
    public function formDefinirLocalAction()
    {
        return [];
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
