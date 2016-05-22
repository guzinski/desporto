<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Profissional;
use DesportoBundle\Entity\Usuario;
use DesportoBundle\Form\ProfissionalType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

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
                "<a href=\"".$this->generateUrl("profissional_form", array("id"=>$profissional->getId()))."\">". $profissional->getNome()."</a>",
                $profissional->getTelefone(),
                $profissional->getNascimento()->format('d/m/Y'),
            ];
        }
        $return = [
            'draw' => $request->get("draw"),
            'recordsTotal' => $repProfissional->count(),
            'recordsFiltered' => $repProfissional->count($busca['value']),
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
     * @Route("/excluir", name="profissional_excluir")
     */
    public function excluirAction(Request $resquest) 
    {
        $respone = array();
        $id = $resquest->request->getInt("id", null);
        if (null != $id) {
            $em = $this->getDoctrine()->getManager();
            $usuario = $em->find(Usuario::class, $id);
            $em->remove($usuario);
            $em->flush();
            $respone['ok'] = 1;
        } else {
            $respone['ok'] = 0;
            $respone['error'] = "Erro ao exclui usuário";
        }
        return new Response(json_encode($respone));
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

    
}

