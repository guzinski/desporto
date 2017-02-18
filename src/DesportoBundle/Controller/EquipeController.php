<?php

namespace DesportoBundle\Controller;

use DateTime;
use DesportoBundle\Entity\Cartao;
use DesportoBundle\Entity\Equipe;
use DesportoBundle\Form\EquipeType;
use DesportoBundle\Repository\EquipeRepository;
use DesportoBundle\Service\EquipeService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Asset\Exception\InvalidArgumentException;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of EquipeController
 * @Route("/equipe")
 * @author Luciano
 */
class EquipeController extends Controller
{
    
    /**
     * @Route("/", name="equipe_index")
     * @Template
     * @return type
     */
    public function indexAction()
    {
        return array();
    }
    
    
    /**
     * @Route("/pagination", name="equipe_pagination")
     */
    public function paginationAction(Request $request)
    {
        $firstResult    = $request->query->getInt("start");
        $maxResults     = $request->query->getInt("length");
        $busca          = $request->get("search");
        
        $repEquipe = $this->getDoctrine()
                            ->getRepository(Equipe::class);
        $equipes = $repEquipe->getEquipes($busca['value'], $maxResults, $firstResult);
        
        $dados = array();
        foreach ($equipes as $equipe) {
            $dados[] = [
                $this->renderView("DesportoBundle::Equipe/pagination.html.twig", ['equipe' => $equipe]),
            ];
        }
        
        $recordsTotal = $repEquipe->count();
        if (!empty($busca['value'])) {
            $recordsFiltered = $repEquipe->count($busca['value']);
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
     * @Route("/complete", name="equipe_find")
     */
    public function completeAction(Request $request)
    {
        $busca = $request->get("q");
        $pagina = $request->get("page");
        if (empty($busca)) {
            throw new InvalidArgumentException;
        }
         
        $repEquipe = $this->getDoctrine()
                            ->getRepository(Equipe::class);
        /*@var $repEquipe EquipeRepository */
        $equipes = $repEquipe->getEquipes($busca, 30, ($pagina-1)*30);
        
        $dados = array();
        foreach ($equipes as $equipe) {
            $dados[] = [
                'id' => $equipe->getId(),
                'full_name' => $equipe->getNome(),
            ];
        }
        $return['items'] = $dados; 
        $return['total_count'] = $repEquipe->count($busca);
        
        return new Response(json_encode($return));
    }
    
    /**
     * @Route("/editar/{id}", name="equipe_form")
     * @Template()
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function formAction(Request $request, $id = null) 
    {
        $em = $this->getDoctrine()->getManager();
        if ($id>0) {
            $equipe = $em->find(Equipe::class, $id);
        } else {
            $equipe = new Equipe();
            $equipe->setUsuarioCadastro($this->getUser());
        }
        $arquivos = clone $equipe->getArquivos();
        $form = $this->createForm(EquipeType::class, $equipe);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->getEquipeService()->salvarEquipe($equipe, $arquivos);                        
            return new RedirectResponse($this->generateUrl('equipe_index'));
        }
        
        return ['form'=>$form->createView(), 'equipe'=>$equipe];
    }
    
    
    /**
     * @Route("/download/{nome}", name="equipe_arquivo_download")
     * 
     * @param int $nome Nome do Arquivo
     * @return Response
     */
    public function downloadArquivoAction($nome = null)
    {
        if (is_null($nome)) {
            throw new NotFoundHttpException;
        }
        if (file_exists($this->get('kernel')->getRootDir() . '/../web/uploads/arquivos/'.$nome)) {
            return $this->get("upload")->download($this->get('kernel')->getRootDir() . '/../web/uploads/arquivos/'.$nome);
        } elseif (file_exists($this->get('kernel')->getRootDir() . '/../web/uploads/temp/'.$nome)) {
            return $this->get("upload")->download($this->get('kernel')->getRootDir() . '/../web/uploads/temp/'.$nome);
        } else {
            throw new NotFoundHttpException;
        }
    }

    /**
     * @Route("/perfil/{id}", name="equipe_perfil")
     * @Template()
     */
    public function perfilAction(Equipe $equipe) 
    {
        $equipeRepo = $this->getDoctrine()->getRepository(Equipe::class);
        $numGols = $equipeRepo->getTotalGolsEquipe($equipe);
        $numCartoesAmarelos = $equipeRepo->getTotalCartoesEquipe($equipe, Cartao::AMARELO);
        $numCartoesVermelhos = $equipeRepo->getTotalCartoesEquipe($equipe, Cartao::VERMELHO);
        
        $historicos = [];
        foreach ($equipe->getEdicoesCampeonatos() as $campeonato) {
            $historicos[] = [
                'historico' => $this->getEquipeService()->getHistoricoEquipeCampeonato($equipe, $campeonato),
                'campeonato' => $campeonato,
            ];            
        }
        
        return ['equipe'=>$equipe, 'numGols'=>$numGols, "numCartoesAmarelos"=> $numCartoesAmarelos, "numCartoesVermelhos"=>$numCartoesVermelhos, 'historicos' => $historicos];
    }
    
    
        /**
     * @Route("/exportar", name="equipe_exportar")
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportarAction(Request $request)
    {        
        $response = new StreamedResponse();
        $response->setCallback(function() use ($request) {
            $handle = fopen('php://output', 'w+');

            // Add the header of the CSV file
            fputcsv($handle, array('Nome', 'Responsável', 'Telefone', 'Endereço'),';');
            
            $equipes = $this->getDoctrine()->getRepository(Equipe::class)->findBy(['id' => array_values($request->get("equipes"))]);
            foreach ($equipes as $equipe) {
                fputcsv(
                    $handle,
                    array($equipe->getNome(), $equipe->getResponsavel(),  $this->get('string_filters')->telefone($equipe->getTelefone()), $equipe->getEndereco()),
                    ';'
                );                
            }

            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="equipes.csv"');
        
        return $response;
    }

    /**
     * @Route("/excluir", name="equipe_excluir")
     * @param Request $request
     * @return RedirectResponse
     */
    public function excluirAction(Request $request)
    {
        $equipes = $this->getDoctrine()->getRepository(Equipe::class)->findBy(['id' => array_values($request->get("equipes"))]);

        $dataExclusao = new DateTime("now"); 
        foreach ($equipes as $equipe) {
             /* @var $equipe Equipe */
             $equipe->setDataExclusao($dataExclusao);
             $equipe->setUsuarioExclusao($this->getUser());
             $this->getDoctrine()->getManager()->persist($equipe);
         }
         $this->getDoctrine()->getManager()->flush();
         
         return new RedirectResponse($this->generateUrl('equipe_index'));
    }


    /**
     * 
     * @return EquipeService
     */
    private function getEquipeService()
    {
        return $this->get("equipe");
    }

}
