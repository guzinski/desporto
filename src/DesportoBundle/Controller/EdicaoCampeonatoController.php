<?php


namespace DesportoBundle\Controller;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Form\EdicaoCampeonatoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of CampeonatoController
 * @Route("/campeonato")
 */
class EdicaoCampeonatoController extends Controller
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
        $form = $this->createForm(EdicaoCampeonatoType::class, $campeonato);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $campeonato->setUsuarioCadastro($this->getUser());

//            $this->get("equipe")->salvarEquipe($campeonato, $arquivos);                        
            return new RedirectResponse($this->generateUrl('equipe_index'));
        }
        return ['form'=>$form->createView()];
    }

    
    
    
    
    
}
