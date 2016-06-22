<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;

/**
 * Description of EquipeData
 *
 */
class EquipeData implements FixtureInterface
{
    
    
    public function load(\Doctrine\Common\Persistence\ObjectManager $manager)
    {
    
        
        $string = "Vitoria|A|Costa|Rua Engenheiro Walter Kurrle 306|(31) 9492-4576
Julius|A|Roberts|Acesso R-Quatro 233|(51) 7660-8593
Vidoslav|A|Blažević|Praça Monteiro Lobato 1533|(16) 6915-8243
Varden|J|Soucy|Avenida Mazzaropi 1500|(11) 6265-4119
Vuk|B|Kovačević|Rua Joaquim de Almeida Morais 110|(11) 8264-2352
Piero|O|Trevisan|Avenida Francisco das Chagas Oliveira 738|(17) 7237-6395
Carl|T|Mattsson|Rua Seis 1365|(21) 4712-8021
Eva|T|Kučírková|Travessa Martins Pena 1422|(16) 5863-5268
Claire|J|Powlett|Rua Nigéria 609|(11) 2853-5083
Isabella|A|Santos|Rua Manoel Rodrigues Roseira 926|(11) 2187-4190
Sabine|G|de Launay|Rua Góes Calmon 561|(71) 2303-2237
Korneli|E|Nowicki|Rua Cento e Sessenta e Seis 137|(11) 2557-7566
Jitka|Z|Koňaříková|Rua Raimundo Manoel Delgado 497|(13) 6034-4063
Lubomir|A|Baryshnikov|Rua Batataes 1971|(11) 2377-6893
Rosita|M|Calabresi|Rua Carolina Pucci Molinar 1996|(34) 8968-3239
Alfie|S|Thorpe|Rua Dois 856|(74) 3776-5213
Kristin|L|Biermann|Quadra QN 319 Conjunto 12 1630|(61) 8927-6837
Nils|T|Öhman|Rua Pica-pau 2|(43) 4515-7665
Czesław|N|Walczak|Rua Sol Nascente 1903|(92) 4909-3727
Teresa|M|Lucchesi|Rua Maria Nicolini Suffredini 1457|(11) 5503-8349
Raakel|A|Autio|Travessa dos Vencedores 715|(84) 2532-3528
Daniele|M|Trevisano|Alameda Juscelino Kubitschek 320|(91) 8664-6854
Kaisa|L|Kallio|Rua Frei Caneca 980|(83) 5684-5200
Praskovya|C|Selezneva|Rua dos Anjos 683|(11) 5910-8439
Kristian|Š|Mađar|Rua D 533|(34) 4394-9087
Jack|S|Howe|Rua Comanches 668|(27) 6274-6796
Eduarda|B|Costa|Rua Professora Alzira Santos de Souza 1602|(55) 7862-6935
Klara|D|Šarić|Rua Aurelino Leal 146|(11) 6394-5073
Felix|L|Berg|Rua Jacinto Marcelino Ferreira 811|(31) 7391-3308
Gemma|C|Dennis|Rua Setenta e Cinco 1803|(21) 2930-2344
Åke|P|Reho|Rua Gália 1878|(19) 8274-2299
Taija|L|Takkula|Rua Embaixador Egberto Mafra 1595|(21) 8388-7049
Nicholas|M|Windeyer|Rua Leverger 736|(21) 9161-5199
Bruno|Š|Dujmović|Rua Passatempo 1567|(86) 3844-6438
Jett|A|Bauer|Vila Josépha 1045|(24) 7110-6635
Leila|F|Correia|Praça Santos Dumont 936|(51) 2633-2252
Oscar|M|Volodin|Rua José Lavagnoli 95|(27) 7459-4025
Kai|S|Nikula|Avenida Bardot 774|(71) 6654-7561
Ludvík|R|Čermák|Rua Madre Anna 1313|(51) 9902-2164
Isra|J|Ivarsson|Rua Olímpio Bazante 189|(81) 8496-5859
Ensio|A|Kuosmanen|Passagem Natália Martel 241|(11) 6357-3213
Seraphim|S|Dubinina|Rua Pero Vaz de Caminha 1988|(19) 7484-9650
Allan|R|Henderson|Rua Edvaldo Bezerra Cavalcanti Pinho 1519|(83) 9116-3327
Adina|P|Jansson|Rua Quatorze de Julho 546|(71) 8388-4923
Richard|N|Háva|Travessa Garcia 270|(12) 4223-6478
Joseph|E|Harry|Rua Engenheiro Paulo Pires 66|(21) 7760-6805
Vitór|P|Gomes|Rua Oito 786|(99) 8696-3595
Cauã|F|Barros|Praça Geraldo Batista Lamim 634|(12) 5776-6046
Tyler|C|O'Brien|Rua Almirante Barroso 122|(11) 2777-6000";
        

        
        $equipesArray = explode("\n", $string);
        
        foreach ($equipesArray as $equipesLine) {
            
            $linha = explode("|", $equipesLine);
            $equipe = new \DesportoBundle\Entity\Equipe();
            $equipe->setApelido($linha[2])
                    ->setBrasao("")
                    ->setEndereco($linha[3])
                    ->setNome($linha[2]. " F C")
                    ->setResponsavel($linha[0]." ".$linha[1].".")
                    ->setTelefone($linha[4]);
            
            $manager->persist($equipe);
        }
        $manager->flush();
        
        
        
    }

    
    
}
