<?php


namespace DesportoBundle\Controller;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Form\EdicaoCampeonatoType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
            $campService = $this->get("edicao_campeonato");
            $campeonato->setUsuarioCadastro($this->getUser());
            
            $campService->salvarTorneio($campeonato);
            
            $em->persist($campeonato);
            $em->flush();
            
//            $this->get("equipe")->salvarEquipe($campeonato, $arquivos);                        
            return new RedirectResponse($this->generateUrl('equipe_index'));
        }
        return ['form'=>$form->createView()];
    }

    /**
     * @Route("/numero/chaves", name="campeonato_numero_chaves")
     * Retorna os npumeros de chaves disponíveis
     * @param Request $request
     * @return RedirectResponse
     */
    public function numeroChavesAction(Request $request)
    {
        $numEquipes = $request->get("numeroEquipes");
        
        if (is_null($numEquipes)) {
            throw new InvalidArgumentException;
        }
        
        $result = array();
        
        $result[] = ['id'=>"", 'text'=>"Selecione"];
        for ($i=1; $i<$numEquipes/2; $i++) {
            if (log($i, 2)-(int)log($i, 2) == 0 && $numEquipes%$i == 0) {
                $result[] = ['id'=>$i,'text'=>$i];
            }
        }
        return new Response(json_encode($result));
    }
    
    
    /**
     * @Route("/numero/classificados", name="campeonato_numero_classificados")
     * Retorna os npumeros de chaves disponíveis
     * @param Request $request
     * @return RedirectResponse
     */
    public function numeroClassificadosAction(Request $request)
    {
        $numEquipes = $request->get("numeroEquipes");
        $numChaves  = $request->get("numeroChaves");
        
        if (is_null($numEquipes) || is_null($numChaves)) {
            throw new InvalidArgumentException;
        }
        
        $numEquipesChave = $numEquipes/$numChaves;
        
        $result = array();
        
        $result[] = ['id'=>"", 'text'=>"Selecione"];
        for ($i=1; $i<$numEquipesChave; $i++) {
            if ($i*$numChaves==1) {
                continue;
            }
            if ($i*$numChaves>16) {
                break;
            }
            if (log($i*$numChaves, 2)-(int)log($i*$numChaves, 2) == 0 ) {
                $result[] = ['id'=>$i,'text'=>$i];
            }
        }
        return new Response(json_encode($result));
    }
    
    
    /**
     * @Route("/html/chaves", name="campeonato_html_chaves")
     * Retorna o HTMl para o form de Chaves
     * @Template()
     * @param Request $request
     * @return array
     */
    public function htmlChavesAction(Request $request)
    {
        $numChaves     = $request->get("numeroChaves");
        $numEquipes    = $request->get("numeroEquipes");
        
        if (is_null($numChaves) || is_null($numEquipes)) {
            throw new InvalidArgumentException;
        }
        
        $numEquipesChave = $numEquipes/$numChaves;
        
        return [   
                'numChaves'=>($numChaves-1),
                'numEquipesChave'=>($numEquipesChave-1)
            ];
    }
    
    /**
     * @Route("/html/torneio", name="campeonato_html_torneio")
     * Retorna o HTMl para o form de Fases Classificatórias
     * @Template()
     * @param Request $request
     * @return array
     */
    public function htmlTorneioAction(Request $request)
    {
        $numEquipes    = $request->get("numeroEquipes");
        
        if (is_null($numEquipes) || (log($numEquipes, 2)-(int)log($numEquipes, 2) != 0)) {
            throw new InvalidArgumentException;
        }
        
        if ($numEquipes == 2) {
            $label = "Final";
            $tipo = \DesportoBundle\Entity\FaseClassificatoria::FINAL_;
        } elseif ($numEquipes == 4) {
            $label = "Semifinal";
            $tipo = \DesportoBundle\Entity\FaseClassificatoria::SEMIFINAL;
        } elseif ($numEquipes == 8) {
            $label = "Quartas de Final";
            $tipo = \DesportoBundle\Entity\FaseClassificatoria::QUARTAS;
        } elseif ($numEquipes == 16) {
            $label = "Oitavas de Final";
            $tipo = \DesportoBundle\Entity\FaseClassificatoria::OITAVAS;
        }
                
        return ['total'=>$numEquipes/2, 'label'=>$label, 'tipo'=>$tipo];
    }
    
    
    
}
