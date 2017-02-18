<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Profissional;
use DesportoBundle\Form\ProfissionalType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\StreamedResponse;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of ProfissionalController
 * @Route("/profissional")
 * @author Luciano
 */
class ProfissionalController extends Controller
{
    
    /**
     * @Route("/", name="profissional_index")
     * @Template()
     */
    public function indexAction() 
    {
        return array();
    }
    
    /**
     * @Route("/pagination", name="profissional_pagination")
     * @Template()
     */
    public function paginationAction(Request $request)
    {
        $firstResult    = $request->query->getInt("start");
        $maxResults     = $request->query->getInt("length");
        $busca          = $request->get("search");
        
        $repProfissional = $this->getDoctrine()
                            ->getRepository(Profissional::class);
        $profissionais = $repProfissional->getProfissionais($busca['value'], $maxResults, $firstResult);
        
        $dados = array();
        foreach ($profissionais as $profissional) {
            $dados[] = [
                $this->renderView("DesportoBundle::Profissional/pagination.html.twig", ['profissional' => $profissional]),
            ];
        }
        
        $recordsTotal = $repProfissional->count();
        if (!empty($busca['value'])) {
            $recordsFiltered = $repProfissional->count($busca['value']);
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
     * @Route("/editar/{id}", name="profissional_form")
     * @Template()
     * 
     * @param Request $request
     * @return RedirectResponse
     */
    public function formAction(Request $request, $id = null) 
    {
        $em = $this->getDoctrine()->getManager();
        if ($id>0) {
            $profissional = $em->find(Profissional::class, $id);
        } else {
            $profissional = new Profissional();
            $profissional->setUsuarioCadastro($this->getUser());
        }
        $arquivos = clone $profissional->getArquivos();
        $form = $this->createForm(ProfissionalType::class, $profissional);
        $form->handleRequest($request);
        if ($form->isValid()) {
            $this->get("profissional")->salvarProfissional($profissional, $arquivos);                        
            return new RedirectResponse($this->generateUrl('profissional_index'));
        }
        
        return ['form'=>$form->createView(), 'profissional'=>$profissional];
    }
    
    /**
     * @Route("/perfil/{id}", name="profissional_perfil")
     * @Template()
     */
    public function perfilAction(Profissional $profissional) 
    {
        return ['profissional'=>$profissional];
    }

    
    /**
     * @Route("/download/{nome}", name="profissional_arquivo_download")
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
     * @Route("/find/jogadores/disponiveis/{campeonato}", name="profissional_find_jogadores_disponiveis")
     * @param Request $request
     */
    public function findJogadoresAction(EdicaoCampeonato $campeonato, Request $request)
    {
        $equipe = $request->get("equipe");
        $strBusca = $request->get("busca");
        $inscritos = $request->get('inscritos');
        
        $profissionais = $this->getDoctrine()
                ->getRepository(Profissional::class)
                ->getJogadoresDisponíveis($campeonato, $equipe, $strBusca, $inscritos);

        return new Response(json_encode($this->preparaResultFindProfissionais($profissionais)));
    }
    
    /**
     * @Route("/find/diretores/disponiveis/{campeonato}", name="profissional_find_diretores_disponiveis")
     * @param Request $request
     */
    public function findDiretoresDisponiveisAction(EdicaoCampeonato $campeonato, Request $request)
    {
        $equipe = $request->get("equipe");
        $strBusca = $request->get("busca");
        
        $profissionais = $this->getDoctrine()
                ->getRepository(Profissional::class)
                ->getDiretoresDisponíveis($campeonato, $equipe, $strBusca);

        return new Response(json_encode($this->preparaResultFindProfissionais($profissionais)));
    }
    
    /**
     * @Route("/find/treinadores/disponiveis/{campeonato}", name="profissional_find_treinadores_disponiveis")
     * @param Request $request
     */
    public function findTreinadoresDisponíveisAction(EdicaoCampeonato $campeonato, Request $request)
    {
        $equipe = $request->get("equipe");
        $strBusca = $request->get("busca");
        
        $profissionais = $this->getDoctrine()
                ->getRepository(Profissional::class)
                ->getTreinadoresDisponíveis($campeonato, $equipe, $strBusca);

        return new Response(json_encode($this->preparaResultFindProfissionais($profissionais)));
    }
    
    
    private function preparaResultFindProfissionais($profissionais)
    {
        $items = array();
        foreach ($profissionais as $profissional) {
            /* @var $profissional Profissional */
            $items[] = [
                'id' => $profissional->getId(),
                'nome' => $profissional->getNome(),
                'cpf' => $this->get("string_filters")->cpf($profissional->getCpf())
            ];
        }

        $return['total_count'] = count($profissionais);
        $return['items'] = $items;
        $return['incomplete_results'] = false;

        return $return;
    }
    
    /**
     * @Route("/exportar", name="profissional_exportar")
     * @param Request $request
     * @return StreamedResponse
     */
    public function exportarAction(Request $request)
    {        
        $response = new StreamedResponse();
        $response->setCallback(function() use ($request) {
            $handle = fopen('php://output', 'w+');

            // Add the header of the CSV file
            fputcsv($handle, array('Nome', 'CPF', 'Telefone', 'Endereço', 'Sexo', 'Nascimento'),';');
            
            $profissionais = $this->getDoctrine()->getRepository(Profissional::class)->findBy(['id' => array_values($request->get("profissionais"))]);
            
            foreach ($profissionais as $profissional) {
                fputcsv(
                    $handle, 
                    array($profissional->getNome(), $this->get('string_filters')->cpf($profissional->getCpf()), $this->get('string_filters')->telefone($profissional->getTelefone()), $profissional->getEndereco(), $profissional->getSexo(), $profissional->getNascimento()->format("d/m/Y")),
                    ';' 
                );                
            }

            fclose($handle);
        });

        $response->setStatusCode(200);
        $response->headers->set('Content-Type', 'text/csv; charset=utf-8');
        $response->headers->set('Content-Disposition', 'attachment; filename="profissionais.csv"');
        
        return $response;
    }

    /**
     * @Route("/excluir", name="profissional_excluir")
     * @param Request $request
     * @return RedirectResponse
     */
    public function excluirAction(Request $request)
    {
        $profissionais = $this->getDoctrine()->getRepository(Profissional::class)->findBy(['id' => array_values($request->get("profissionais"))]);

        $dataExclusao = new \DateTime("now"); 
        foreach ($profissionais as $profissional) {
             /* @var $profissional Profissional */
             $profissional->setDataExclusao($dataExclusao);
             $profissional->setUsuarioExclusao($this->getUser());
             $this->getDoctrine()->getManager()->persist($profissional);
         }
         $this->getDoctrine()->getManager()->flush();
         
         return new RedirectResponse($this->generateUrl('profissional_index'));
    }

    
}

