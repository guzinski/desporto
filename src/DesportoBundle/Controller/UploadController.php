<?php

namespace DesportoBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Description of UploadController
 * @Route("/upload", name="upload_chunk")
 * @author Luciano
 */
class UploadController extends Controller
{
         
    /**
     * @Route("/", name="upload_chunk")
     * 
     * @return Response
     */
    public function uploadAction() 
    {
        $upload = $this->get("upload");
        $result = $upload->handleUpload($this->get('kernel')->getRootDir()."/../web/uploads/temp");
        
        if (isset($result['error'])) {
            $response =  new Response($result['error']);
            return $response->setStatusCode(500);
        } else {
            $result['link'] = $this->generateUrl("upload_download_temp", ["nome" => $result['fileName']]);
            return new Response(json_encode($result));
        }
    }
    
    /**
     * @Route("/delete/temp", name="upload_delete_temp")
     * 
     * @return Response
     */
    public function deleteTempAction()
    {
        $upload = $this->get("upload");
        $result = $upload->handleDelete($this->get('kernel')->getRootDir()."/../web/uploads/temp");
        if (isset($result['error'])) {
            $response =  new Response($result['error']);
            return $response->setStatusCode(500);
        }
        return new Response(json_encode($result));
    }
    
    /**
     * @Route("/tempp/download/{nome}", name="upload_download_temp")
     * 
     * @return Response
     */
    public function linkTempAction($nome)
    {
        return $this->get("upload")->download($this->get('kernel')->getRootDir() . '/../web/uploads/temp/'.$nome);
    }
    
    
    
}
