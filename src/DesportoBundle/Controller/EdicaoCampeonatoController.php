<?php


namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Entity\FaseClassificatoria;
use DesportoBundle\Form\EdicaoCampeonatoType;
use DesportoBundle\Service\EdicaoCampeonatoService;
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
        $campeonato = new EdicaoCampeonato($this->getUser());
        $form = $this->createForm(EdicaoCampeonatoType::class, $campeonato);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getService()->salvarCampeonato($campeonato);
            return new RedirectResponse($this->generateUrl('campeonato_detalhe', array('campeonato'=>$campeonato->getId())));
        }
        return ['form'=>$form->createView()];
    }
    
    /**
     * @Route("/detalhe/{campeonato}", name="campeonato_detalhe")
     * @Template()
     * @param Campeonato $campeonato
     */
    public function detalheAction(EdicaoCampeonato $campeonato)
    {
        if ($campeonato->getStatus()==EdicaoCampeonato::AGUARDANDO_CONVOCACAO) {
            return $this->redirectToRoute("campeonato_convocacao", array("campeonato"=>$campeonato->getId()));
        }
        return array("campeonato"=>$campeonato);
    }

    /**
     * @Route("/convocacao/{campeonato}", name="campeonato_convocacao")
     * @Template()
     * @param EdicaoCampeonato $campeonato
     * @return array
     */
    public function convocacaoAction(EdicaoCampeonato $campeonato)
    {
        return array("campeonato"=>$campeonato);
    }

    /**
     * @Route("/numero/chaves", name="campeonato_numero_chaves")
     * Retorna os números de chaves possíveis
     * @param Request $request
     * @return RedirectResponse
     */
    public function numeroChavesAction(Request $request)
    {
        $numEquipes = $request->get("numeroEquipes");
        if (is_null($numEquipes)) {
            throw new InvalidArgumentException;
        }
        
        $result = [['id'=>"", 'text'=>"Selecione"],];
        
        $quantidadesPossiveisChaves = $this->getService()->getQuantidadesPossiveisChaves($numEquipes);
        
        foreach ($quantidadesPossiveisChaves as $quantidadePossivelChave) {
            $result[] = ['id'=>$quantidadePossivelChave,'text'=>$quantidadePossivelChave];
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
        
        if (empty($numEquipes) || empty($numChaves)) {
            throw new InvalidArgumentException;
        }

        $quantidadesPossiveisClassificados = $this->getService()->getQuantidadePossiveisClassificados($numEquipes, $numChaves);
        
        $result = [['id'=>"", 'text'=>"Selecione"]];
        foreach ($quantidadesPossiveisClassificados as $quantidadePossivelClassificados) {
            $result[] = ['id'=>$quantidadePossivelClassificados,'text'=>$quantidadePossivelClassificados];
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
        
        if (empty($numChaves) || empty($numEquipes)) {
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
            $tipo = FaseClassificatoria::FINAL_;
        } elseif ($numEquipes == 4) {
            $label = "Semifinal";
            $tipo = FaseClassificatoria::SEMIFINAL;
        } elseif ($numEquipes == 8) {
            $label = "Quartas de Final";
            $tipo = FaseClassificatoria::QUARTAS;
        } elseif ($numEquipes == 16) {
            $label = "Oitavas de Final";
            $tipo = FaseClassificatoria::OITAVAS;
        }
                
        return ['total'=>$numEquipes/2, 'label'=>$label, 'tipo'=>$tipo];
    }
    

    /**
     * @Route("/form/inscricao/jogadores", name="campeonato_form_inscricao_jogadores")
     * @Template()
     * @param Request $request
     */
    public function formInscricaoJogadoresAction(Request $request)
    {
        $idEquipe = $request->get("equipe");
        $idCampeonato = $request->get("campeonato");
        
        if (empty($idEquipe) || empty($idCampeonato)) {
            throw new \InvalidArgumentException;
        }
        $jogadores = $this->getDoctrine()->getRepository(\DesportoBundle\Entity\Profissional::class)->getJogadoresInscritos($idEquipe, $idCampeonato);
        
        return array("jogadores"=>$jogadores, "equipeId"=>$idEquipe);
    }
    
    /**
     * @Route("/adicionar/jogador", name="campeonato_adicionar_jogador")
     * @Template()
     * @param Request $request
     */
    public function adicionarJogadorAction(Request $request) 
    {
        $idEquipe = $request->get("equipe");
        $idCampeonato = $request->get("campeonato");
        $idJogador = $request->get("jogador");
        
        $jogador  = $this->getDoctrine()->getEntityManager()->find(\DesportoBundle\Entity\Profissional::class, $idJogador);
        
        return array("jogador"=>$jogador, );
    }
    
    /**
     * @Route("/inscrever/jogadores/{campeonato}", name="campeonato_inscrever_jogadores")
     * @param Request $request
     */
    public function inscreverJogadorAction(EdicaoCampeonato $campeonato, Request $request) 
    {
        $equipe = $request->get("equipe");
        $inscritos = $request->get("inscritos");

        $campService = $this->get("edicao_campeonato")->inscreverJogadores($campeonato, $equipe, $inscritos); 
        return new Response();
    }
    
    /**
     * 
     * @return EdicaoCampeonatoService
     */
    public function getService()
    {
        return $this->get("edicao_campeonato");
    }
    
    
    
}
