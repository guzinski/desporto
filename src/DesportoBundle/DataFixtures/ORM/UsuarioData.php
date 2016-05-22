<?php

namespace DesportoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DesportoBundle\Entity\Nivel;
use DesportoBundle\Entity\Permissao;
use DesportoBundle\Entity\Usuario;

/**
 * Description of NivelData
 *
 * @author Luciano
 */
class UsuarioData implements FixtureInterface
{
    
    
    public function load(ObjectManager $manager)
    {
        
        $nivel = new Nivel("Administrador");
                
        $nivel->getPermissoes()->add(new Permissao("Usuários", "USUARIO"));
        $nivel->getPermissoes()->add(new Permissao("Profissional", "PROFISSIONAL"));
        $nivel->getPermissoes()->add(new Permissao("Equipe", "EQUIPE"));

        $manager->persist($nivel);
        
        $usuario = new Usuario();
        $usuario->setEmail("lucianoguzinski@gmail.com")
                ->setNome("Luciano Guzinski")
                ->setSenha("123456")
                ->setNivel($nivel);
        
        $manager->persist($usuario);
        $manager->flush();
    }

    
    
    
    
    
}
