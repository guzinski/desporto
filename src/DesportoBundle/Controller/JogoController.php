<?php

namespace DesportoBundle\Controller;

use DesportoBundle\Entity\Jogo;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

/**
 * Description of JogoController
 * @Route("/jogo")
 * @author Luciano
 */
class JogoController extends Controller
{
    
    /**
     * 
     * @Route("/{jogo}", name="jogo_detalhar")
     * @Template()
     * @param Jogo $jogo
     */
    public function detalharAction(Jogo $jogo) 
    {
        return ['jogo'=>$jogo];
    }
    
    
}
