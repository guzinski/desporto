<?php

namespace DesportoBundle\DataFixtures\ORM;

use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\Modalidade;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Description of Modalidade
 *
 * @author Luciano
 */
class CampeonatoData implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $modalidadeCampo = New Modalidade("Campo");
        $modalidadeFutsal = New Modalidade("Futsal");
        
        $campoSerieOuro = new Campeonato("Campo - Série Ouro", $modalidadeCampo);
        $campoSeriePrata = new Campeonato("Campo - Série Prata", $modalidadeCampo);
        $futsalSerieOuro = new Campeonato("Futsal - Série Ouro", $modalidadeFutsal);
        $futsalSeriePrata = new Campeonato("Futsal - Série Prata", $modalidadeFutsal);
        $futsalSerieBronze = new Campeonato("Futsal - Série Bronze", $modalidadeFutsal);
        
        
        $manager->persist($campoSerieOuro);
        $manager->persist($campoSeriePrata);
        $manager->persist($futsalSerieOuro);
        $manager->persist($futsalSeriePrata);
        $manager->persist($futsalSerieBronze);
        $manager->flush();

    }
            
}
