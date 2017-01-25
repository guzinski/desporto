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
     * @Route("/", name="campeonato_index")
     * @Template()
     * @return type
     */
    public function indexAction()
    {
        return [];
    }
    
    /**
     * @Route("/pagination", name="campeonato_pagination")
     */
    public function paginationAction(Request $request)
    {
        $firstResult    = $request->query->getInt("start");
        $maxResults     = $request->query->getInt("length");
        $busca          = $request->get("search");
        
        $repCampeonatos = $this->getDoctrine()
                            ->getRepository(EdicaoCampeonato::class);
        $campeonatos = $repCampeonatos->getCampeonatos($busca['value'], $maxResults, $firstResult);
        $dados = array();
        foreach ($campeonatos as $campeonato) {
            $dados[] = [
                "<a href=\"".$this->generateUrl("campeonato_detalhe", array("campeonato"=>$campeonato->getId()))."\">". $campeonato->getCampeonato()->getNome()."</a>",
                $campeonato->getEdicao(),
                $campeonato->getModalidade() == \DesportoBundle\Doctrine\Type\EnumSexoType::MASCULINO ? "Masculino" : "Feminino",
            ];
        }
        
        $recordsTotal = $repCampeonatos->count();
        if (!empty($busca['value'])) {
            $recordsFiltered = $repCampeonatos->count($busca['value']);
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
     * @param Campeonato $campeonato
     */
    public function detalheAction(EdicaoCampeonato $campeonato)
    {
        if ($campeonato->getStatus()==EdicaoCampeonato::AGUARDANDO_CONVOCACAO) {
            return $this->redirectToRoute("campeonato_convocacao", array("campeonato"=>$campeonato->getId()));
        }
        $tabela = $this->getService()->calculaTabela($campeonato);
        if ($campeonato->getTipo() == EdicaoCampeonato::PONTOS_CORRIDOS) {
            return $this->render("DesportoBundle::EdicaoCampeonato\pontosCorridosDetalhe.html.twig", ["campeonato"=>$campeonato, "tabela"=>$tabela]);
        } elseif ($campeonato->getTipo() == EdicaoCampeonato::TORNEIO) {
            return $this->render("DesportoBundle::EdicaoCampeonato\torneio.html.twig", ["campeonato"=>$campeonato, "tabela"=>$tabela]);
        } elseif ($campeonato->getTipo() == EdicaoCampeonato::CHAVE) {
            return $this->render("DesportoBundle::EdicaoCampeonato\chaveDetalhe.html.twig", ["campeonato"=>$campeonato, "tabela"=>$tabela]);
        }

    }

    /**
     * @Route("/convocacao/{campeonato}", name="campeonato_convocacao")
     * @Template()
     * @param EdicaoCampeonato $campeonato
     * @return array
     */
    public function convocacaoAction(EdicaoCampeonato $campeonato)
    {
//        $this
//    ->get('doctrine')
//    ->getConnection()
//    ->getConfiguration()
//    ->setSQLLogger(new \Doctrine\DBAL\Logging\EchoSQLLogger());

        $equipes = $this->getDoctrine()->getRepository(Equipe::class)->getEquipesCampeonato($campeonato, TRUE);
//        var_dump($equipes);
//        die();
        return array("campeonato"=>$campeonato, "equipes" => $equipes);
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
            throw new \InvalidArgumentException;
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
            
        $return = $this->getService()->getTipoTorneioByNumeroEquipes($numEquipes);

        $return['total'] = $numEquipes/2;
        
        return $return;
    }
    

    /**
     * @Route("/form/inscricao/jogadores/{campeonato}", name="campeonato_form_inscricao_jogadores")
     * @Template()
     * @param Request $request
     */
    public function formInscricaoJogadoresAction(EdicaoCampeonato $campeonato, Request $request)
    {
        $idEquipe = $request->get("equipe");

        if (empty($idEquipe) || is_null($campeonato)) {
            throw new \InvalidArgumentException;
        }
        
        $equipe = $this->getDoctrine()
                ->getRepository(\DesportoBundle\Entity\Equipe::class)->findOneBy(['id'=> $idEquipe]);
        
        $jogadores = $this->getDoctrine()
                ->getRepository(\DesportoBundle\Entity\Profissional::class)
                ->getJogadoresInscritos($campeonato, $idEquipe);

        return array("jogadores" => $jogadores, "equipe" => $equipe);
    }
    
    /**
     * @Route("/form/inscricao/profissional/{campeonato}", name="campeonato_form_inscricao_profissional")
     * @Template()
     * @param Request $request
     */
    public function formInscricaoProfissionalAction(EdicaoCampeonato $campeonato, Request $request)
    {
        $idEquipe = $request->get("equipe");
        $tipo = $request->get("tipo");

        if (empty($idEquipe) || is_null($campeonato) || empty($tipo)) {
            throw new \InvalidArgumentException;
        }
        
        $equipe = $this->getDoctrine()
                ->getRepository(\DesportoBundle\Entity\Equipe::class)->findOneBy(['id'=> $idEquipe]);

        return array("equipe" => $equipe, 'tipo'=>$tipo);
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

        $this->getService()->inscreverJogadores($campeonato, $equipe, $inscritos); 
        return new Response();
    }
    
    /**
     * @Route("/inscrever/profissional/{campeonato}", name="campeonato_inscrever_profissional")
     * @param Request $request
     */
    public function inscreverProfissionalAction(EdicaoCampeonato $campeonato, Request $request) 
    {
        $equipe = $request->get("equipe");
        $profissional = $request->get("profissional");
        $tipo = $request->get("tipo");

        $retorno = $this->getService()->inscreverProfissional($campeonato, $equipe, $profissional, $tipo); 
        return new Response(json_encode($retorno));
    }


    
    /**
     * @Route("/finalizar/inscricao/{campeonato}", name="campeonato_finalizar_inscricao")
     * @param Request $request
     */
    public function finalizarInscricaoAction(EdicaoCampeonato $campeonato) 
    {
        $retorno['finalizado'] = $this->getService()->verificafinalizacaoInscricao($campeonato);
        return new Response(json_encode($retorno));
    }
    
    /**
     * 
     * @return EdicaoCampeonatoService
     */
    private function getService()
    {
        return $this->get("edicao_campeonato");
    }
    
}


