<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Suspensao;
use DesportoBundle\Form\JulgamentoType;
use InvalidArgumentException;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Description of JulgamentoController
 * @Route("/julgamento")
 * @author Luciano
 */
class JulgamentoController extends Controller
{
    
    /**
     * @Route("/", name="julgamento_index")
     * @Template()
     */
    public function indexAction() 
    {
        return array();
    }
    
    /**
     * @Route("/julgados", name="julgamento_julgados")
     * @Template()
     */
    public function julgadosAction() 
    {
        return array();
    }
    
    /**
     * @Route("/pagination", name="julgamento_pagination")
     * @Template()
     */
    public function paginationAction(Request $request)
    {
        $firstResult    = $request->query->getInt("start");
        $maxResults     = $request->query->getInt("length");
        $busca          = $request->get("search");
        $julgado         = $request->get("julgada");
        
        $repSuspensao = $this->getDoctrine()
                            ->getRepository(Suspensao::class);
        $suspensoes = $repSuspensao->getJulgamentos($julgado, $busca['value'], $firstResult, $maxResults);
        
        $dados = array();
        foreach ($suspensoes as $suspensao) {
            /* @var $suspensao Suspensao */
            $dados[] = [
                $suspensao->getInscricao()->getProfissional()->getNome(),
                $suspensao->getInscricao()->getEquipe()->getNome(),
                $suspensao->getInscricao()->getEdicaoCampeonato()->getCampeonato()->getNome(). " - ". $suspensao->getInscricao()->getEdicaoCampeonato()->getEdicao(),
                $julgado ? "<a class='btn btn-default' href='". $this->generateUrl("julgamento_visualizar", ['suspensao'=>$suspensao->getId()]) ."'>Ver Punição</a>" : "<a class='btn btn-default' href='". $this->generateUrl("julgamento_julgar", ['suspensao'=>$suspensao->getId()]) ."'>Julgar</a>",
            ];
        }
        
        $recordsTotal = $repSuspensao->count($julgado);
        if (!empty($busca['value'])) {
            $recordsFiltered = $repSuspensao->count($julgado, $busca['value']);
        } else {
            $recordsFiltered = $recordsTotal;
        }
        
        
        $return = [
            'draw' => $request->get("draw"),
            'recordsTotal' => $recordsTotal,
            'recordsFiltered' => $recordsFiltered,
            'data' => $dados,
        ];
        return new Response(json_encode($return));
    }

    
    /**
     * @Route("/julgar/{suspensao}", name="julgamento_julgar")
     * @Template()
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function julgarAction(Suspensao $suspensao,  Request $request) 
    {
        if ($suspensao->isJulgada()) {
            throw new InvalidArgumentException;
        }
        $em = $this->getDoctrine()->getManager();
        $form = $this->createForm(JulgamentoType::class, $suspensao);
        $form->handleRequest($request);
        if ($form->isValid() && $form->isSubmitted()) {
            $suspensao->setJulgada(TRUE);
            $em->persist($suspensao);
            $em->flush();
            return $this->redirect($this->generateUrl('julgamento_index'));
        }
        
        return ['form'=>$form->createView(), 'suspensao'=>$suspensao];
    }
    
    /**
     * @Route("/visualizar/{suspensao}", name="julgamento_visualizar")
     * @Template()
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function visualizarAction(Suspensao $suspensao) 
    {        
        return ['suspensao'=>$suspensao];
    }

    
    
}
