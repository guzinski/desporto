<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Equipe;
use DesportoBundle\Form\EquipeType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

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
     * @Template()
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
                "<a href=\"".$this->generateUrl("equipe_form", array("id"=>$equipe->getId()))."\">". $equipe->getNome()."</a>",
                $equipe->getTelefone(),
                $equipe->getResponsavel(),
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
            $this->get("equipe")->salvarEquipe($equipe, $arquivos);                        
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


}
