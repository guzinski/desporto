<?php

namespace DesportoBundle\DataFixtures\ORM;

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
        $modalidadeCampo = New \DesportoBundle\Entity\Modalidade("Campo");
        $modalidadeFutsal = New \DesportoBundle\Entity\Modalidade("Futsal");
        
        $campoSerieOuro = new \DesportoBundle\Entity\Campeonato("Campo - Série Ouro", $modalidadeCampo);
        $campoSeriePrata = new \DesportoBundle\Entity\Campeonato("Campo - Série Prata", $modalidadeCampo);
        $futsalSerieOuro = new \DesportoBundle\Entity\Campeonato("Futsal - Série Ouro", $modalidadeFutsal);
        $futsalSeriePrata = new \DesportoBundle\Entity\Campeonato("Futsal - Série Prata", $modalidadeFutsal);
        $futsalSerieBronze = new \DesportoBundle\Entity\Campeonato("Futsal - Série Bronze", $modalidadeFutsal);
        
        
        $manager->persist($campoSerieOuro);
        $manager->persist($campoSeriePrata);
        $manager->persist($futsalSerieOuro);
        $manager->persist($futsalSeriePrata);
        $manager->persist($futsalSerieBronze);
        $manager->flush();

    }
            
}
