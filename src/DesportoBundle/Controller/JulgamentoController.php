<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
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
                            ->getRepository(\DesportoBundle\Entity\Suspensao::class);
        $suspensoes = $repSuspensao->getJulgamentos($julgado, $busca['value'], $firstResult, $maxResults);
        
        $dados = array();
        foreach ($suspensoes as $suspensao) {
            /* @var $suspensao \DesportoBundle\Entity\Suspensao */
            $dados[] = [
                    $suspensao->getInscricao()->getEdicaoCampeonato()->getCampeonato()->getNome(). " - ". $suspensao->getInscricao()->getEdicaoCampeonato()->getEdicao(),
                    $suspensao->getInscricao()->getEquipe()->getNome(),
                    $suspensao->getInscricao()->getProfissional()->getNome(),
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

    
    
}
