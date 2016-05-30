<?php


namespace DesportoBundle\Controller;

use DesportoBundle\Entity\EdicaoCampeonato;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of CampeonatoController
 * @Route("/campeonato")
 */
class CampeonatoController extends Controller
{
    
    /**
     * @Route("/novo", name="campeonato_novo")
     * @Template()
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function novoAction(Request $request) 
    {
        $em = $this->getDoctrine()->getManager();
        $campeonato = new EdicaoCampeonato();
        //$campeonato->setUsuarioCadastro($this->getUser());
//        $form = $this->createForm(EquipeType::class, $campeonato);
//        $form->handleRequest($request);
//        if ($form->isValid()) {
////            $this->get("equipe")->salvarEquipe($campeonato, $arquivos);                        
//            return new RedirectResponse($this->generateUrl('equipe_index'));
//        }
//        return ['form'=>$form->createView()];
        return [];
    }

    
    
    
    
    
}
