<?php

namespace DesportoBundle\DataFixtures\ORM;

use DesportoBundle\Entity\Nivel;
use DesportoBundle\Entity\Permissao;
use DesportoBundle\Entity\Usuario;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Description of UsuarioData
 *
 * @author Luciano
 */
class UsuarioData implements FixtureInterface, ContainerAwareInterface
{

    /**
     * @var ContainerInterface
     */
    private $container;

    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }


    public function load(ObjectManager $manager)
    {

        $nivel = new Nivel("Administrador");
                
        $nivel->getPermissoes()->add(new Permissao("Usuários", "USUARIO"));
        $nivel->getPermissoes()->add(new Permissao("Profissional", "PROFISSIONAL"));
        $nivel->getPermissoes()->add(new Permissao("Equipe", "EQUIPE"));
        $nivel->getPermissoes()->add(new Permissao("Campeonato", "CAMPEONATO"));

        $manager->persist($nivel);

        $encoder = $this->container->get("security.encoder_factory")->getEncoder(new Usuario());

        $usuario = new Usuario();
        $usuario->setEmail("lucianoguzinski@gmail.com")
                ->setNome("Luciano Guzinski")
                ->setSenha($encoder->encodePassword("132456", null))
                ->setNivel($nivel);
        
        $manager->persist($usuario);
        $manager->flush();
    }

    
    
    
    
    
}
