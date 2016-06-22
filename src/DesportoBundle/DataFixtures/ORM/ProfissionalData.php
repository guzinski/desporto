<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use DesportoBundle\Entity\Profissional;

/**
 * Description of ProifssionalData
 *
 */
class ProfissionalData implements FixtureInterface
{
    
    
    public function load(ObjectManager $manager)
    {


        $string = "Diego|S|Ribeiro|male|Rua Rivalino 948|DiegoSilvaRibeiro@dayrep.com|(31) 6289-2147|6/15/1968
Gustavo|F|Pinto|male|Passagem Amazonex 1921|GustavoFernandesPinto@cuvox.de|(91) 7860-6946|11/16/1974
Vitór|C|Alves|male|Rua Oliveira Viana 595|VitorCastroAlves@armyspy.com|(41) 6586-3557|11/12/1987
Carlos|R|Cunha|male|Praça Raul Gomes Pinheiro Machado 1914|CarlosRodriguesCunha@gustr.com|(14) 8581-5646|7/3/1996
Letícia|C|Barbosa|female|Avenida Cezar Mingossi 1342|LeticiaCardosoBarbosa@gustr.com|(16) 3662-7845|9/19/1979
Felipe|R|Barbosa|male|Rua Antônio Mayer 271|FelipeRochaBarbosa@dayrep.com|(11) 2638-2993|5/30/1994
Diogo|S|Silva|male|Rua Carlos Rogge Neto 1144|DiogoSouzaSilva@gustr.com|(47) 4305-6499|8/13/1955
Anna|C|Ferreira|female|Condomínio Recanto do Mene B 1521|AnnaCarvalhoFerreira@einrot.com|(61) 9315-6242|12/12/1993
Emilly|F|Cavalcanti|female|Rua Joana Capistrano de Carvalho 588|EmillyFernandesCavalcanti@cuvox.de|(71) 7850-7440|6/17/1980
Sophia|M|Silva|female|Rua 1 850|SophiaMartinsSilva@jourrapide.com|(85) 9041-3240|4/5/1980
Eduarda|S|Martins|female|Rua Maria Lourdes de Franca 1476|EduardaSousaMartins@dayrep.com|(83) 2998-9464|4/15/1956
Bruna|L|Rocha|female|Rua Adélia Bordon Marchini 257|BrunaLimaRocha@rhyta.com|(19) 4188-6473|9/27/1971
André|C|Melo|male|Rua Herbert Arruda Pereira 1696|AndreCostaMelo@einrot.com|(11) 9045-2988|9/14/1962
Martim|A|Lima|male|Rua A-3 1061|MartimAzevedoLima@jourrapide.com|(31) 9424-7730|1/11/1970
Yasmin|F|Almeida|female|Viela Cachoeira 804|YasminFerreiraAlmeida@gustr.com|(11) 6313-6094|8/14/1989
José|D|Fernandes|male|Rua Laiz Ribeiro dos Santos Bicudo 32|JoseDiasFernandes@superrito.com|(11) 5214-7520|7/16/1992
Brenda|S|Almeida|female|Rua Bernardo Borges 1230|BrendaSantosAlmeida@superrito.com|(21) 8967-5000|1/26/1967
Leonardo|A|Araujo|male|Rua Doutor Rui Cortes 871|LeonardoAlmeidaAraujo@jourrapide.com|(21) 5691-5481|5/19/1996
Kai|A|Rodrigues|male|Estrada do Pununduva 1313|KaiAlvesRodrigues@fleckens.hu|(11) 6137-2355|9/26/1983
Thiago|S|Alves|male|Quadra SHCES Quadra 0301 Bloco C 1869|ThiagoSilvaAlves@fleckens.hu|(61) 2027-7820|7/29/1971
Guilherme|C|Castro|male|Avenida Itaipu 1738|GuilhermeCostaCastro@fleckens.hu|(34) 9717-3102|6/16/1963
Julieta|A|Pereira|female|Rua Antônio Domingues Freitas 1138|JulietaAlvesPereira@gustr.com|(11) 9647-4650|1/16/1972
Amanda|B|Azevedo|female|Rua Sideral 1610|AmandaBarbosaAzevedo@teleworm.us|(11) 6365-6168|10/24/1958
Otávio|B|Melo|male|Rua Ituiutaba 365|OtavioBarbosaMelo@cuvox.de|(62) 4107-2839|5/5/1957
Fábio|P|Azevedo|male|Quadra CL 517 Bloco E 111|FabioPereiraAzevedo@jourrapide.com|(61) 4477-6270|12/16/1982
Aline|B|Ribeiro|female|Rua Bahia 1854|AlineBarrosRibeiro@fleckens.hu|(81) 9914-3508|11/10/1983
Leila|C|Fernandes|female|Viela Vinte 433|LeilaCastroFernandes@dayrep.com|(11) 6354-3025|12/28/1967
Emilly|C|Ribeiro|female|Rua Londrina 1559|EmillyCorreiaRibeiro@jourrapide.com|(11) 2721-3206|2/18/1989
Alex|S|Fernandes|male|Travessa Marincek 1144|AlexSousaFernandes@einrot.com|(16) 7506-8509|9/17/1987
Evelyn|R|Almeida|female|Rua Vitória-Régia 1982|EvelynRibeiroAlmeida@armyspy.com|(34) 6156-7579|6/11/1982
Alice|C|Oliveira|female|Rua Padre Cícero 1823|AliceCostaOliveira@rhyta.com|(81) 7001-7354|12/18/1976
Felipe|C|Castro|male|Rua Colômbia 201|FelipeCostaCastro@jourrapide.com|(31) 3801-4764|4/16/1962
Danilo|R|Almeida|male|Quadra QNO 02 1388|DaniloRochaAlmeida@teleworm.us|(61) 3554-4677|3/20/1974
Diego|A|Fernandes|male|Vila Gengiskan 788|DiegoAlmeidaFernandes@cuvox.de|(85) 9534-9907|9/25/1995
Larissa|G|Santos|female|Quadra CLN 05 Bloco H 111|LarissaGomesSantos@cuvox.de|(61) 3181-7520|9/13/1996
Sophia|C|Souza|female|Rua da Ascensão 474|SophiaCunhaSouza@armyspy.com|(44) 7645-6970|5/17/1994
Beatrice|L|Martins|female|Rua Dionísia Tomé de Camargo 1935|BeatriceLimaMartins@einrot.com|(15) 2166-3597|1/29/1981
Vinicius|C|Melo|male|Travessa Capitão Clementino Paraná 293|ViniciusCunhaMelo@fleckens.hu|(41) 6846-6702|9/16/1962
Arthur|B|Araujo|male|Avenida Doutor Luiz Mezzalira Filho 784|ArthurBarbosaAraujo@armyspy.com|(54) 6348-6715|6/1/1969
Ágatha|S|Souza|female|Rua Quebec 1547|AgathaSantosSouza@dayrep.com|(16) 2598-7240|4/5/1970
Gabriel|P|Dias|male|Praça José Adriano Marrey Júnior 914|GabrielPintoDias@fleckens.hu|(18) 3993-9933|10/10/1974
Vitória|C|Silva|female|Rua Riachuelo 793|VitoriaCunhaSilva@jourrapide.com|(51) 2754-4595|6/5/1973
Alex|F|Dias|male|Rua Hermann Fritzke 731|AlexFerreiraDias@superrito.com|(47) 4959-7490|8/25/1984
Júlia|S|Alves|female|Rua Flora Magnabosco 109|JuliaSilvaAlves@teleworm.us|(54) 9307-2530|8/26/1996
Laura|C|Barros|female|Rua Ezequiel Pereira 1455|LauraCunhaBarros@dayrep.com|(82) 7799-4597|1/11/1985
Nicolash|O|Azevedo|male|Rua Dom Bosco 303|NicolashOliveiraAzevedo@fleckens.hu|(11) 3492-6321|9/21/1965
Davi|C|Barbosa|male|Rua Jornalista Jorge Freire 1089|DaviCunhaBarbosa@teleworm.us|(84) 9724-6846|9/24/1978
Bianca|O|Castro|female|Rua Vinte e Três de Maio 1575|BiancaOliveiraCastro@cuvox.de|(27) 6410-4897|9/20/1988
Isabela|C|Araujo|female|Rua Tupi 417|IsabelaCostaAraujo@rhyta.com|(66) 4040-2276|8/6/1991
Rodrigo|G|Cunha|male|Avenida Joventino 1973|RodrigoGoncalvesCunha@teleworm.us|(71) 5115-7870|12/2/1986
Lara|S|Carvalho|female|Rua Duzentos e Vinte e Quatro 162|LaraSantosCarvalho@armyspy.com|(24) 2599-6925|7/26/1982
Giovanna|D|Barros|female|Avenida Quinzinho Pintado 1692|GiovannaDiasBarros@rhyta.com|(34) 2708-2176|11/18/1990
Bruno|C|Costa|male|Rua Abará 687|BrunoCunhaCosta@teleworm.us|(11) 6637-4595|10/21/1971
Isabela|G|Ferreira|female|Rua Anna Fachin Vieira 1684|IsabelaGomesFerreira@armyspy.com|(16) 7021-9604|1/8/1986
Brenda|C|Souza|female|Quadra QNJ 12 1651|BrendaCorreiaSouza@dayrep.com|(61) 2229-9120|9/28/1963
Emily|F|Carvalho|female|Rua Roque Bataglia 439|EmilyFernandesCarvalho@dayrep.com|(17) 6688-4310|8/28/1986
Julian|A|Pinto|male|Rua Ana Cristina Cesar 1337|JulianAraujoPinto@superrito.com|(21) 8325-7080|6/7/1997
Arthur|R|Souza|male|Rua Rogério Bacon 959|ArthurRochaSouza@rhyta.com|(11) 8793-3304|12/3/1978
Emilly|C|Barbosa|female|Rua Jorge de Castro 1949|EmillyCavalcantiBarbosa@teleworm.us|(21) 9895-2778|8/15/1989
Thiago|A|Almeida|male|Praça Quatro 1407|ThiagoAlvesAlmeida@dayrep.com|(34) 9692-6163|1/14/1988
Joao|G|Rocha|male|Rua Luiza Tente 1845|JoaoGoncalvesRocha@armyspy.com|(32) 7176-2320|1/22/1992
Clara|R|Oliveira|female|Viela Piaf 1935|ClaraRodriguesOliveira@armyspy.com|(11) 8505-4421|5/23/1984
Eduardo|C|Araujo|male|Rua Macaé 392|EduardoCorreiaAraujo@jourrapide.com|(67) 3247-6450|5/4/1989
Danilo|M|Correia|male|Quadra QI 04 Bloco O 454|DaniloMartinsCorreia@teleworm.us|(61) 7561-5621|5/7/1973
Danilo|P|Santos|male|Rua Dona Antônia Bezerra 1391|DaniloPintoSantos@armyspy.com|(81) 8720-5926|7/19/1994
Bruna|S|Alves|female|Rua João Barreiros 1506|BrunaSilvaAlves@einrot.com|(11) 6297-6285|4/25/1984
Douglas|C|Melo|male|Rua Marcílio Machado da Silveira 564|DouglasCunhaMelo@fleckens.hu|(54) 6392-9769|6/14/1972
Vinicius|S|Lima|male|Rua João Mendes da Silva 1957|ViniciusSousaLima@superrito.com|(21) 8269-4905|9/1/1968
Mariana|A|Santos|female|Rua Ipê Rosa 1436|MarianaAraujoSantos@gustr.com|(19) 3400-2360|11/13/1990
Luís|C|Ferreira|male|Rua Generosa Moreira de Almeida 1645|LuisCorreiaFerreira@rhyta.com|(11) 5514-9410|5/1/1971
Marisa|O|Rocha|female|Rua Aguaí 136|MarisaOliveiraRocha@jourrapide.com|(11) 3122-8259|12/27/1995
Daniel|P|Dias|male|Rua Orixa 217|DanielPereiraDias@fleckens.hu|(21) 2170-6490|6/1/1982
André|G|Cunha|male|Vila Jardim Nazaré 1638|AndreGoncalvesCunha@rhyta.com|(85) 4852-9874|12/3/1970
Kauê|A|Silva|male|Rua H-11 150|KaueAzevedoSilva@cuvox.de|(92) 5929-7034|5/5/1959
Isabella|S|Cardoso|female|Travessa São Jorge 869|IsabellaSouzaCardoso@gustr.com|(11) 4346-9500|1/6/1959
Beatriz|A|Cardoso|female|Estrada Velha do Rócio 1517|BeatrizAlmeidaCardoso@fleckens.hu|(41) 6167-2823|3/2/1961
Kauê|M|Almeida|male|Rua Guaraciaba 269|KaueMartinsAlmeida@dayrep.com|(31) 3915-3658|11/4/1994
Victor|P|Castro|male|Rua Antônio Romano 1623|VictorPereiraCastro@armyspy.com|(11) 9762-4732|10/19/1963
Estevan|M|Ferreira|male|Rua José Maria Alkimin 1356|EstevanMeloFerreira@dayrep.com|(19) 8552-9685|12/5/1955
Rodrigo|A|Pereira|male|Avenida Ouro Preto 494|RodrigoAraujoPereira@fleckens.hu|(33) 7815-5983|2/10/1996
Bianca|A|Almeida|female|Rua C 1677|BiancaAraujoAlmeida@cuvox.de|(38) 7992-7191|11/22/1992
Bianca|S|Lima|female|Praça Paulino Alonso 788|BiancaSantosLima@dayrep.com|(16) 3958-9822|10/22/1989
Tiago|A|Gomes|male|Travessa Cristo Rei 874|TiagoAlmeidaGomes@teleworm.us|(85) 3713-5087|12/29/1989
Felipe|B|Pinto|male|Praça Nagib Mussi Rocha 1971|FelipeBarbosaPinto@rhyta.com|(22) 8190-7538|12/21/1996
Gabrielle|R|Souza|female|Rua Comendador Arly Gomes Ribeiro 1880|GabrielleRochaSouza@armyspy.com|(19) 6233-6452|4/22/1997
Letícia|B|Cardoso|female|Avenida Eraldo Barbosa de Souza 1073|LeticiaBarrosCardoso@dayrep.com|(81) 2204-4726|4/14/1968
Ryan|C|Fernandes|male|Rua R 2 1510|RyanCorreiaFernandes@gustr.com|(62) 3162-8221|6/26/1971
Letícia|A|Sousa|female|Rua Doutor Elizardo Elias de Souza 203|LeticiaAraujoSousa@einrot.com|(62) 6408-2672|12/3/1968
Lucas|F|Sousa|male|Rua João Evangelista Neto 1089|LucasFernandesSousa@gustr.com|(11) 9014-4878|9/18/1964
Rafael|S|Dias|male|Rua Ana Garcia 1976|RafaelSantosDias@gustr.com|(21) 2073-4666|10/10/1987
Igor|C|Sousa|male|Rua 20 564|IgorCavalcantiSousa@einrot.com|(62) 7952-9070|1/17/1979
Vitór|S|Cavalcanti|male|Rua Maria Geraldina Ramos 88|VitorSilvaCavalcanti@armyspy.com|(48) 8370-7617|12/24/1955
Carlos|B|Ferreira|male|Rua Marieta Araújo Nascimento 1224|CarlosBarrosFerreira@teleworm.us|(83) 7710-3059|4/29/1957
Diogo|D|Oliveira|male|Rua Braz Florenzano 903|DiogoDiasOliveira@fleckens.hu|(15) 6422-5511|12/13/1985
Tomás|S|Goncalves|male|Rua Teixeira Mendes 1718|TomasSilvaGoncalves@gustr.com|(21) 8580-7894|5/21/1981
Lavinia|L|Correia|female|Rua São Tiago 44|LaviniaLimaCorreia@teleworm.us|(27) 9423-9273|5/24/1968
Luís|C|Goncalves|male|Rua Vinte do Canal 1747|LuisCavalcantiGoncalves@cuvox.de|(71) 2466-6208|10/12/1962
Diego|C|Ribeiro|male|Rua Ricardo Bueno 634|DiegoCastroRibeiro@fleckens.hu|(21) 2163-7623|4/20/1989
Yasmin|L|Rocha|female|Rua Poeta Dantas Mota 1985|YasminLimaRocha@jourrapide.com|(31) 5780-7145|7/22/1979
Aline|R|Castro|female|Rua dos Crisântemos 1649|AlineRodriguesCastro@armyspy.com|(11) 4455-7688|6/22/1986
Tiago|C|Pinto|male|Rua Comendador José Júlio de Mello 1241|TiagoCardosoPinto@superrito.com|(51) 4323-5055|5/25/1984
Arthur|O|Pinto|male|Rua José Amaral 972|ArthurOliveiraPinto@jourrapide.com|(11) 9178-9600|3/27/1996
Brenda|S|Pinto|female|Avenida Pedro Olímpio da Fonseca 183|BrendaSilvaPinto@gustr.com|(31) 9555-4318|3/25/1983
Guilherme|B|Cunha|male|Rua Nova Era 1730|GuilhermeBarbosaCunha@teleworm.us|(27) 8306-2849|3/26/1969
Beatriz|R|Souza|female|Travessa Vista Alegre 247|BeatrizRochaSouza@einrot.com|(21) 9660-5849|12/14/1978
Estevan|B|Rocha|male|Rua Poeta Manoel Rodrigues de Melo 1401|EstevanBarbosaRocha@armyspy.com|(84) 7329-9514|3/18/1956
Rafaela|R|Carvalho|female|Rua Tenente Pinto Duarte 183|RafaelaRibeiroCarvalho@dayrep.com|(42) 7635-5075|4/29/1986
Giovanna|B|Silva|female|Rua Ailton Luiz Nodari 460|GiovannaBarrosSilva@dayrep.com|(41) 4411-4663|4/19/1958
Fernanda|M|Silva|female|Rua Dezessete 155|FernandaMeloSilva@cuvox.de|(27) 8651-7889|1/19/1993
Alex|S|Pereira|male|Praça Centenário 300|AlexSantosPereira@superrito.com|(35) 8825-2931|12/31/1985
Nicolash|M|Azevedo|male|Rua Beiradão 1138|NicolashMartinsAzevedo@armyspy.com|(21) 6486-8390|2/27/1976
Beatriz|C|Pereira|female|Travessa Vinte e Dois 1948|BeatrizCarvalhoPereira@dayrep.com|(21) 2760-9633|3/5/1986
Luís|D|Rocha|male|Travessa São Francisco 200|LuisDiasRocha@superrito.com|(99) 8346-6593|7/20/1995
Leila|A|Dias|female|Rua Frei Vicente Salvador 747|LeilaAzevedoDias@cuvox.de|(81) 2706-2352|4/25/1981
André|P|Cardoso|male|Praça Y 1703|AndrePereiraCardoso@jourrapide.com|(34) 3169-9012|2/13/1997
Lucas|C|Gomes|male|Colônia Agrícola Vicente Pires 1689|LucasCarvalhoGomes@rhyta.com|(61) 4432-8058|3/22/1988
Danilo|C|Pinto|male|Rua PL 6 64|DaniloCunhaPinto@armyspy.com|(62) 9355-7391|7/7/1981
Sophia|G|Araujo|female|Rua Francisco Gomes 880|SophiaGomesAraujo@einrot.com|(31) 6412-7665|9/13/1982
Eduardo|R|Gomes|male|Rua Inez Cintra 1458|EduardoRochaGomes@jourrapide.com|(14) 4880-7842|11/7/1961
Vitor|C|Souza|male|Rua Guimarães Pessoa 1600|VitorCunhaSouza@gustr.com|(81) 6196-8971|1/23/1989
Diego|P|Ribeiro|male|Rua Poeta Duque da Costa 1667|DiegoPintoRibeiro@gustr.com|(24) 9309-7936|7/3/1967
Rafaela|C|Alves|female|Rua Dezessete 775|RafaelaCavalcantiAlves@gustr.com|(51) 2683-3175|2/3/1958
Fernanda|A|Gomes|female|Rua Sem Nome 1175|FernandaAraujoGomes@fleckens.hu|(61) 7745-5901|9/23/1971
Luan|P|Gomes|male|Praça da Conquista 1156|LuanPereiraGomes@cuvox.de|(11) 3249-5786|5/19/1973
Tânia|B|Castro|female|Quadra CLN 105 1616|TaniaBarrosCastro@rhyta.com|(61) 6634-5662|7/20/1984
Caio|R|Almeida|male|Rua Barão de Studart 1759|CaioRibeiroAlmeida@gustr.com|(11) 5139-4485|4/6/1963
Alex|R|Cavalcanti|male|Rua Dom Pedro I 636|AlexRochaCavalcanti@jourrapide.com|(74) 8804-3217|7/30/1980
Carlos|S|Silva|male|Rua Maricá 55|CarlosSantosSilva@superrito.com|(27) 2018-8253|6/16/1965
Brenda|G|Oliveira|female|Passagem Joelda 503|BrendaGomesOliveira@armyspy.com|(91) 5267-8774|1/13/1990
Kauan|S|Cardoso|male|Rua Riachuelo 447|KauanSilvaCardoso@einrot.com|(99) 8535-7276|1/20/1996
Thaís|M|Souza|female|Rua Uruguai 854|ThaisMeloSouza@fleckens.hu|(16) 7850-4605|9/9/1973
Mariana|F|Barbosa|female|Quadra QR 602 Conjunto 10 965|MarianaFerreiraBarbosa@armyspy.com|(61) 9243-7932|12/15/1959
Rodrigo|A|Goncalves|male|Rua Manacás 28|RodrigoAzevedoGoncalves@einrot.com|(11) 8877-3503|11/4/1961
Luis|A|Rocha|male|Rua Rio Grande do Norte 1903|LuisAlmeidaRocha@fleckens.hu|(42) 8430-9464|8/18/1961
Marcos|C|Silva|male|Rua José Alves do Nascimento 1691|MarcosCunhaSilva@dayrep.com|(11) 6544-6383|12/11/1988
Bruno|S|Goncalves|male|Rua Coronel Celestino 1058|BrunoSousaGoncalves@superrito.com|(38) 3791-5631|8/8/1991
Diogo|B|Gomes|male|Avenida Visconde de Jequitinhonha 1419|DiogoBarbosaGomes@einrot.com|(21) 4178-5276|12/3/1979
Rafael|F|Correia|male|Beco São José 541|RafaelFerreiraCorreia@einrot.com|(31) 4315-2302|9/18/1994
Caio|C|Barros|male|Rua Isabel dos Anjos 1197|CaioCastroBarros@teleworm.us|(85) 2925-6608|11/17/1963
Kai|C|Araujo|male|Rua das Figueiras 366|KaiCardosoAraujo@teleworm.us|(11) 2493-5960|1/10/1959
Paulo|L|Silva|male|Travessa Schibuola 1915|PauloLimaSilva@dayrep.com|(16) 9982-6332|6/10/1963
André|C|Oliveira|male|Vila João Justen Sobrinho 1383|AndreCunhaOliveira@jourrapide.com|(24) 2323-3462|1/7/1980
Felipe|M|Cavalcanti|male|Rua Souza Naves 453|FelipeMartinsCavalcanti@gustr.com|(42) 9001-2732|5/21/1968
Renan|G|Almeida|male|Rua do Pica-Pau 1668|RenanGoncalvesAlmeida@superrito.com|(87) 7157-8186|2/28/1963
Julieta|A|Rodrigues|female|Rua Professor Noé de Lima 1045|JulietaAlmeidaRodrigues@jourrapide.com|(32) 4682-4700|4/11/1977
José|C|Santos|male|Rua Linhares 1107|JoseCunhaSantos@fleckens.hu|(27) 3420-2041|6/14/1971
Arthur|C|Martins|male|Quadra 208 Sul Alameda 8 1771|ArthurCastroMartins@cuvox.de|(63) 8625-4915|7/4/1967
Kaua|S|Cardoso|male|Rua Felício Rosa Madruga 1141|KauaSouzaCardoso@cuvox.de|(49) 9956-3700|6/28/1966
Giovana|M|Barbosa|female|Alameda Anglo Arabe 603|GiovanaMartinsBarbosa@cuvox.de|(11) 9666-8068|11/15/1976
Aline|D|Araujo|female|Rua G 8|AlineDiasAraujo@jourrapide.com|(33) 6940-3792|4/4/1996
Paulo|C|Pinto|male|Rua Leonardo Sender 395|PauloCardosoPinto@cuvox.de|(21) 8480-3847|6/6/1963
Ágatha|G|Dias|female|Rua Francisco Anysio de Paula Cavalcanti 885|AgathaGomesDias@fleckens.hu|(83) 7503-4600|5/26/1974
Giovanna|M|Oliveira|female|Rua Professora Regina Célia Marinoni 1151|GiovannaMeloOliveira@fleckens.hu|(41) 6161-5233|1/24/1957
Fernanda|C|Goncalves|female|Travessa Godinho 957|FernandaCunhaGoncalves@einrot.com|(55) 6909-3263|6/18/1959
Martim|C|Ribeiro|male|Rua Tompson Flores 185|MartimCunhaRibeiro@fleckens.hu|(31) 7584-2160|11/13/1960
Paulo|S|Silva|male|Rua Hercília Bueno de Souza Junqueira 31|PauloSantosSilva@rhyta.com|(16) 7481-4784|1/23/1971
Gabrielle|M|Correia|female|Rua Léo Marant 902|GabrielleMartinsCorreia@gustr.com|(31) 3255-3910|2/21/1975
Gabrielly|P|Almeida|female|Rua Pedro Loss 1477|GabriellyPintoAlmeida@gustr.com|(49) 5676-5665|4/20/1958
Igor|C|Rodrigues|male|Estrada do Barro Vermelho 855|IgorCostaRodrigues@rhyta.com|(21) 7784-3430|5/11/1972
Breno|B|Almeida|male|Rua do Colibri 234|BrenoBarbosaAlmeida@einrot.com|(87) 2998-8674|9/21/1984
Clara|G|Araujo|female|Rua Raimundo Teixeira Barbosa 32|ClaraGomesAraujo@dayrep.com|(31) 4035-3798|12/17/1966
Clara|G|Sousa|female|Rua Finlândia 179|ClaraGomesSousa@teleworm.us|(12) 7323-5001|10/7/1980
Rafaela|A|Rocha|female|Rua Antônio Borges 603|RafaelaAlmeidaRocha@gustr.com|(11) 2488-9192|2/19/1980
Caio|P|Costa|male|Avenida Pioneiros 1344|CaioPintoCosta@teleworm.us|(61) 6661-2245|11/20/1987
Larissa|G|Rodrigues|female|Rua Joinville 337|LarissaGomesRodrigues@gustr.com|(81) 4091-5673|8/10/1975
Luana|R|Barbosa|female|Rua Sete 1870|LuanaRibeiroBarbosa@fleckens.hu|(24) 9404-2353|7/8/1969
Douglas|S|Costa|male|Vila Sebastião 1362|DouglasSantosCosta@rhyta.com|(11) 3158-8397|9/16/1989
Victor|F|Cardoso|male|Rua Sete 1495|VictorFernandesCardoso@fleckens.hu|(11) 8492-3226|6/17/1992
Júlio|P|Ribeiro|male|Rua Porto Alegre 53|JulioPintoRibeiro@teleworm.us|(11) 4052-7783|10/4/1991
Guilherme|A|Ribeiro|male|Travessa do Cardeal 391|GuilhermeAzevedoRibeiro@teleworm.us|(71) 4720-7095|6/2/1973
Luan|M|Santos|male|Avenida Alberto Torres 894|LuanMartinsSantos@dayrep.com|(22) 4110-5509|10/1/1966
Fernanda|A|Cavalcanti|female|Rua Guaçuí 1780|FernandaAraujoCavalcanti@teleworm.us|(27) 8404-9454|3/2/1960
Gabriel|P|Silva|male|Caminho D-7 824|GabrielPereiraSilva@armyspy.com|(71) 5237-2334|7/28/1995
Renan|C|Santos|male|Rua Cinco 32|RenanCastroSantos@gustr.com|(86) 4653-6423|10/27/1976
Kaua|S|Araujo|male|Rua Giuseppe Giuliano 331|KauaSouzaAraujo@teleworm.us|(19) 7807-3676|11/29/1955
Sophia|D|Almeida|female|Rua Divino Bortolotto 865|SophiaDiasAlmeida@fleckens.hu|(44) 3472-6655|10/4/1983
Camila|B|Dias|female|Rua Doutor Abi Ramia 163|CamilaBarrosDias@fleckens.hu|(21) 8629-3060|4/15/1987
Luis|M|Santos|male|Rua Um 631|LuisMeloSantos@rhyta.com|(11) 5410-6634|12/13/1981
Marina|F|Pinto|female|Rua Quarenta e Oito 107|MarinaFernandesPinto@armyspy.com|(31) 9764-6589|1/28/1956
Victor|S|Castro|male|Rua Guarapari 165|VictorSilvaCastro@fleckens.hu|(21) 7006-8734|12/25/1972
Erick|C|Castro|male|Caminho 56-Qd F 845|ErickCarvalhoCastro@teleworm.us|(71) 2126-5004|3/25/1972
Nicolas|C|Costa|male|Rua Nicoleta Carvalho Borges 1956|NicolasCarvalhoCosta@jourrapide.com|(21) 4478-4201|5/16/1962
Mateus|O|Souza|male|Rua Teres Faria 1188|MateusOliveiraSouza@dayrep.com|(31) 4267-7064|7/16/1984
Letícia|L|Pereira|female|Rua Cisne Branco 402|LeticiaLimaPereira@superrito.com|(11) 9325-5065|11/22/1967
Rodrigo|G|Fernandes|male|Rua Mato Grosso 1989|RodrigoGomesFernandes@gustr.com|(31) 5094-5316|1/15/1988
Kauan|C|Goncalves|male|Rua 10 605|KauanCostaGoncalves@superrito.com|(92) 3823-8412|8/30/1996
Breno|C|Azevedo|male|Rua das Hortências 691|BrenoCostaAzevedo@einrot.com|(19) 5786-5461|6/27/1988
Júlio|F|Melo|male|Beco Andaluzia 694|JulioFerreiraMelo@jourrapide.com|(92) 4999-8607|5/20/1985
Brenda|L|Pereira|female|Avenida Vereador João Sena 1435|BrendaLimaPereira@rhyta.com|(34) 8033-3995|9/28/1971
Julia|A|Azevedo|female|Rua José Ferreira 636|JuliaAraujoAzevedo@armyspy.com|(19) 6162-4068|8/21/1971
Sophia|C|Alves|female|Rua José Três 1446|SophiaCavalcantiAlves@teleworm.us|(28) 4920-7658|5/6/1978
Tomás|B|Cardoso|male|Rua Maria José de Brito Panzarin 1092|TomasBarrosCardoso@rhyta.com|(11) 9206-5095|5/31/1970
Eduarda|C|Alves|female|Avenida Getúlio Vargas 892|EduardaCavalcantiAlves@teleworm.us|(81) 9060-8195|5/27/1967
Caio|C|Costa|male|Rua Genésio Ferreira Bretas 720|CaioCarvalhoCosta@fleckens.hu|(62) 9768-6737|2/5/1963
Beatrice|G|Barros|female|Rua Raimunda da Silva Teles 1952|BeatriceGomesBarros@cuvox.de|(11) 6730-6807|10/29/1962
Bianca|M|Rocha|female|Rua dos Inconfidentes 1910|BiancaMeloRocha@jourrapide.com|(27) 8606-9127|11/2/1979
Diego|C|Cunha|male|Rua Almirante Garnier 1945|DiegoCardosoCunha@jourrapide.com|(53) 2502-3354|12/18/1996
Luana|S|Costa|female|Rua Atílio Andreazza 784|LuanaSousaCosta@dayrep.com|(54) 6091-8919|1/17/1973
Rodrigo|B|Castro|male|Rua Eduardo Costa 345|RodrigoBarbosaCastro@superrito.com|(11) 5868-9558|6/22/1973
André|C|Fernandes|male|Rua Sibipiruna 475|AndreCorreiaFernandes@einrot.com|(34) 5900-3334|1/2/1981
Vinícius|L|Dias|male|Avenida José Martins Miraveti 638|ViniciusLimaDias@dayrep.com|(17) 5042-3976|5/21/1977
Camila|C|Martins|female|Rua Francisco Galvão da Cruz 724|CamilaCastroMartins@gustr.com|(63) 2218-9343|9/9/1982
Matilde|C|Oliveira|female|Travessa Belém 1864|MatildeCostaOliveira@armyspy.com|(16) 8739-6014|10/8/1965
Miguel|B|Pinto|male|Rua Alexandrina Maria de Oliveira 215|MiguelBarbosaPinto@gustr.com|(31) 9210-6901|3/29/1992
Vinicius|B|Ferreira|male|Rua Salvador 1413|ViniciusBarrosFerreira@rhyta.com|(67) 6511-3201|7/25/1971
Brenda|C|Ferreira|female|Rua Hélio D'Avila 1066|BrendaCarvalhoFerreira@einrot.com|(12) 5071-7377|5/26/1993
Julia|D|Azevedo|female|Rua Joaquim Gonçalves Ledo 469|JuliaDiasAzevedo@cuvox.de|(11) 5110-3632|1/23/1975
Lucas|O|Alves|male|Avenida das Indústrias 1281|LucasOliveiraAlves@gustr.com|(31) 2884-5656|12/9/1955
Luana|C|Lima|female|Rua B 1504|LuanaCarvalhoLima@cuvox.de|(62) 2314-2090|2/14/1981
Letícia|C|Barbosa|female|Rua João Pereira 1634|LeticiaCostaBarbosa@superrito.com|(21) 3724-8749|11/8/1982
Isabelle|B|Melo|female|Rua Sigma 938|IsabelleBarbosaMelo@armyspy.com|(81) 6012-6992|8/31/1993
Isabela|R|Santos|female|Rua Ipê 103|IsabelaRibeiroSantos@einrot.com|(37) 6053-3558|6/7/1970
Fábio|L|Cardoso|male|Avenida Carlos Gomes 29|FabioLimaCardoso@rhyta.com|(79) 3676-3119|2/15/1979
Vinicius|C|Correia|male|Rua Nova das Flores 676|ViniciusCostaCorreia@armyspy.com|(71) 5773-2225|1/5/1967
Igor|R|Martins|male|Rua São Luiz 1067|IgorRodriguesMartins@einrot.com|(42) 4804-2662|11/28/1982
Vinícius|C|Melo|male|Rua Dez de Junho 1164|ViniciusCardosoMelo@dayrep.com|(75) 8646-6496|6/9/1980
Thiago|C|Oliveira|male|Rua Arnaldo Manica 178|ThiagoCostaOliveira@armyspy.com|(45) 6984-2274|11/21/1957
Rafael|S|Almeida|male|Rua Boa Esperança 1476|RafaelSantosAlmeida@rhyta.com|(91) 7182-7624|12/16/1984
Luís|C|Rocha|male|Rua dos Botanicos 543|LuisCardosoRocha@rhyta.com|(21) 4069-3924|2/26/1988
Rafaela|L|Cunha|female|Rua Treze 1200|RafaelaLimaCunha@superrito.com|(14) 8999-4332|4/1/1961
Davi|B|Cavalcanti|male|Rua Conselheiro Lafaiete 586|DaviBarbosaCavalcanti@einrot.com|(84) 3669-9046|2/5/1965
Carlos|R|Ferreira|male|Rua Jorge Bordalo Valente 1702|CarlosRochaFerreira@rhyta.com|(21) 4663-3417|8/23/1964
Melissa|C|Barbosa|female|Rua Luís Bueno 1922|MelissaCarvalhoBarbosa@fleckens.hu|(21) 7394-5548|2/9/1970
Martim|A|Costa|male|Rua Guilherme Willemann 428|MartimAlvesCosta@dayrep.com|(48) 6256-7708|3/23/1971
Samuel|C|Oliveira|male|Rua Falia 1949|SamuelCastroOliveira@superrito.com|(21) 3407-5327|2/6/1959
Sarah|M|Gomes|female|Rua D 844|SarahMartinsGomes@teleworm.us|(66) 7260-2455|3/17/1986
Carolina|M|Rodrigues|female|Rua Dom Manuel 1009|CarolinaMartinsRodrigues@superrito.com|(85) 7945-7615|2/12/1983
Carolina|B|Ribeiro|female|Rua Manoel Máximo Pereira 1794|CarolinaBarbosaRibeiro@dayrep.com|(27) 5579-5634|12/29/1961
Guilherme|S|Sousa|male|Rua Mairata 970|GuilhermeSilvaSousa@cuvox.de|(31) 6048-6663|2/5/1970
Fábio|G|Ribeiro|male|Rua País de Gales 503|FabioGoncalvesRibeiro@einrot.com|(43) 5363-8306|10/14/1986
Luiza|A|Alves|female|Travessa Paulino Câmara 205|LuizaAlmeidaAlves@jourrapide.com|(81) 8630-6674|5/16/1994
Thiago|C|Almeida|male|Travessa Benedita Bittencourt Machado 28|ThiagoCastroAlmeida@dayrep.com|(11) 2964-7799|9/29/1967
Julia|C|Barbosa|female|Rua Deyse do Nascimento Weffort 487|JuliaCardosoBarbosa@armyspy.com|(43) 3404-2492|1/16/1974
Brenda|R|Azevedo|female|Rua Hemenegildo Tosin 634|BrendaRochaAzevedo@jourrapide.com|(41) 8997-4268|4/4/1996
Estevan|R|Oliveira|male|Rua Aragoiania 1843|EstevanRibeiroOliveira@jourrapide.com|(21) 6100-5293|3/3/1996
Luiza|F|Cavalcanti|female|Rua Antenor Gomes dos Santos 1094|LuizaFerreiraCavalcanti@dayrep.com|(21) 3531-4350|8/12/1992
Tiago|A|Ferreira|male|Rua Bento Frias 745|TiagoAraujoFerreira@teleworm.us|(11) 6007-6531|11/9/1961
Alice|S|Araujo|female|Rua Angélica Castro 1037|AliceSilvaAraujo@superrito.com|(53) 6976-6093|4/22/1996
Luana|G|Silva|female|Rua G 1377|LuanaGomesSilva@rhyta.com|(31) 8817-3294|9/2/1978
Laura|P|Barros|female|Rua Joaquim Prudêncio 317|LauraPereiraBarros@cuvox.de|(11) 5440-9488|6/11/1967
Erick|S|Almeida|male|Travessa Cabugi 447|ErickSilvaAlmeida@superrito.com|(84) 7573-3618|10/7/1991
Leonor|G|Barros|female|Rua Norberto Lopes de Freitas 852|LeonorGoncalvesBarros@gustr.com|(13) 9696-2376|3/4/1986
Mariana|C|Cardoso|female|Rua Dona Alice 1885|MarianaCunhaCardoso@einrot.com|(21) 6744-3576|5/15/1976
Otávio|C|Lima|male|Avenida República 1063|OtavioCardosoLima@superrito.com|(14) 4701-4196|12/20/1968
Bruna|M|Ferreira|female|Rua Cachoeira Buriti 484|BrunaMeloFerreira@superrito.com|(11) 5048-8776|1/18/1964
Vitór|C|Oliveira|male|Rua BW-02 586|VitorCastroOliveira@einrot.com|(31) 6013-2153|8/10/1961
Enzo|C|Araujo|male|Rua Santa Clara 21|EnzoCavalcantiAraujo@rhyta.com|(98) 9038-9146|4/28/1963
Otávio|S|Dias|male|Rua Dezessete 259|OtavioSousaDias@cuvox.de|(21) 8067-6875|1/23/1967
Thaís|M|Gomes|female|Travessa B 4 670|ThaisMartinsGomes@fleckens.hu|(92) 6933-8610|6/28/1966
Bruna|C|Martins|female|Rua Santa Ceia 1805|BrunaCastroMartins@dayrep.com|(31) 3927-5573|9/9/1965
Guilherme|F|Ferreira|male|Rua El Salvador 847|GuilhermeFernandesFerreira@gustr.com|(31) 8333-6606|7/30/1995
Erick|R|Dias|male|Rua Maria José de Souza Oliveira 1796|ErickRibeiroDias@gustr.com|(47) 3740-5402|10/6/1993
Eduardo|R|Alves|male|Rua Tapejara 1121|EduardoRibeiroAlves@gustr.com|(45) 9171-3639|6/8/1975
Aline|A|Melo|female|Quadra SQS 108 Bloco I 1243|AlineAzevedoMelo@rhyta.com|(61) 5530-2815|6/6/1988
Leonor|G|Correia|female|Conjunto SMDB Conjunto 28 487|LeonorGomesCorreia@jourrapide.com|(61) 3064-6578|2/12/1957
Nicolash|S|Rocha|male|Travessa Hildebrando Moreira 1338|NicolashSouzaRocha@rhyta.com|(21) 4079-4091|12/20/1960
Brenda|C|Barros|female|Rua Três 350|BrendaCorreiaBarros@einrot.com|(31) 3840-9682|2/19/1983
Camila|O|Barbosa|female|Rua C 84 1011|CamilaOliveiraBarbosa@gustr.com|(62) 9332-9728|10/17/1959
Daniel|R|Cardoso|male|Rua Colina 220|DanielRibeiroCardoso@gustr.com|(31) 2335-9616|12/10/1993
Thiago|A|Barros|male|Travessa Elba 166|ThiagoAzevedoBarros@einrot.com|(21) 3803-4459|3/7/1972
Aline|P|Dias|female|Rua VIII 1165|AlinePereiraDias@einrot.com|(85) 2424-6407|2/20/1976
Luis|F|Pinto|male|Praça Leônidas Polachine Figueiredo 1808|LuisFerreiraPinto@superrito.com|(11) 3787-9366|2/20/1997
José|G|Ribeiro|male|Rua Nova da Igreja 1603|JoseGomesRibeiro@dayrep.com|(71) 9271-6286|5/20/1967
Clara|A|Gomes|female|Rua Seis 1315|ClaraAlvesGomes@gustr.com|(11) 8409-4861|12/23/1972
Raissa|C|Santos|female|Rua Galiléia 235|RaissaCardosoSantos@armyspy.com|(27) 3197-9020|4/10/1988
Julieta|P|Rocha|female|Rua Cuiabá 553|JulietaPintoRocha@cuvox.de|(34) 9547-5319|1/12/1980
Julian|C|Barros|male|Rua José Barbosa de Siqueira 507|JulianCarvalhoBarros@teleworm.us|(87) 9514-8292|11/15/1968
Vitória|D|Rocha|female|Rua Serra da Lagoa 54|VitoriaDiasRocha@teleworm.us|(11) 4712-8887|8/7/1968
André|L|Gomes|male|Travessa Onze de Junho 1254|AndreLimaGomes@armyspy.com|(68) 7106-3597|3/3/1959
Aline|S|Pinto|female|Servidão Augusto Mussel 33|AlineSouzaPinto@einrot.com|(24) 4938-3547|8/13/1960
Gustavo|G|Alves|male|Rua General Osório 567|GustavoGoncalvesAlves@gustr.com|(27) 9175-2879|6/18/1973
Anna|G|Rodrigues|female|Rua Iconha 909|AnnaGoncalvesRodrigues@fleckens.hu|(27) 5486-5108|5/12/1982
André|C|Cardoso|male|Rua Cassiterita 1302|AndreCostaCardoso@cuvox.de|(11) 2798-8758|12/5/1961
Kauã|O|Ferreira|male|Rua Nossa Senhora da Penha 1738|KauaOliveiraFerreira@gustr.com|(27) 9922-5367|4/10/1975
Kai|O|Rocha|male|Vila Quatro Irmãos 332|KaiOliveiraRocha@superrito.com|(91) 3238-6750|5/27/1979
Breno|P|Gomes|male|Travessa Fidelcina 602|BrenoPereiraGomes@superrito.com|(71) 3903-8943|10/26/1955
Daniel|C|Pinto|male|Rua Seis 1032|DanielCavalcantiPinto@gustr.com|(12) 9164-4936|5/23/1988
Ágatha|M|Souza|female|Rua Lourenço Inácio 1774|AgathaMartinsSouza@dayrep.com|(21) 2589-6354|4/26/1995
Rodrigo|B|Gomes|male|Rua 34 13|RodrigoBarrosGomes@superrito.com|(85) 4765-2971|12/12/1980
Daniel|S|Cunha|male|Avenida Toyobo 1982|DanielSilvaCunha@jourrapide.com|(19) 4050-3917|12/29/1955
Julian|S|Dias|male|Rua Soldado José Solano 1831|JulianSousaDias@rhyta.com|(21) 5899-9209|5/7/1987
Lucas|F|Barbosa|male|Rua Sebastião Pereira da Silva 1777|LucasFernandesBarbosa@teleworm.us|(27) 7111-7880|4/14/1978
Vitor|P|Souza|male|Rua Antônio Teixeira de Miranda 1331|VitorPereiraSouza@cuvox.de|(19) 9447-7657|2/28/1985
Rafael|B|Ferreira|male|Quadra Quadra 239 92|RafaelBarrosFerreira@einrot.com|(61) 2348-8131|8/4/1995
Mariana|C|Martins|female|Rua Jornalista Manoel Cabeda Perez 429|MarianaCostaMartins@teleworm.us|(55) 7736-5952|11/15/1987
Tiago|P|Carvalho|male|Rua Oito de Outubro 422|TiagoPintoCarvalho@einrot.com|(47) 9177-4565|4/13/1972
Davi|L|Sousa|male|Quadra Quadra 114 Conjunto 11-A 104|DaviLimaSousa@superrito.com|(61) 4675-4603|11/19/1962
Matheus|G|Dias|male|Rua BS 39 1376|MatheusGoncalvesDias@einrot.com|(62) 2670-2942|3/5/1957
Murilo|L|Rocha|male|Alameda Coronel Miranda Prado 1582|MuriloLimaRocha@teleworm.us|(17) 8074-9146|10/3/1970
Anna|C|Araujo|female|Rua Barão da Foz 1290|AnnaCarvalhoAraujo@cuvox.de|(11) 9590-3151|7/16/1977
Samuel|S|Fernandes|male|Rua Ediberto Celestino de Oliveira 837|SamuelSilvaFernandes@dayrep.com|(67) 9917-2209|12/17/1984
Rebeca|S|Pereira|female|Rua Ceará 183|RebecaSouzaPereira@rhyta.com|(41) 8784-2612|4/18/1982
Larissa|B|Cardoso|female|Rua EF 29 1686|LarissaBarrosCardoso@dayrep.com|(62) 4227-7362|3/3/1959
Paulo|C|Rodrigues|male|Rua Magnólia 676|PauloCunhaRodrigues@jourrapide.com|(21) 7587-5124|6/20/1962
Gabrielly|C|Santos|female|Rua Resende 1485|GabriellyCastroSantos@rhyta.com|(81) 3602-5671|11/10/1988
Leonardo|R|Lima|male|Rua Doutor Eugênio Marzola 404|LeonardoRodriguesLima@jourrapide.com|(16) 7806-3159|1/2/1962
Carla|R|Cardoso|female|Rua Isabel Zen Zagonel 1052|CarlaRibeiroCardoso@gustr.com|(41) 3029-9302|11/22/1981
Marisa|C|Pereira|female|Conjunto Deus Quer 190|MarisaCunhaPereira@armyspy.com|(86) 8736-3615|7/20/1985
Emily|M|Pinto|female|Rua B 696|EmilyMeloPinto@teleworm.us|(38) 2022-2939|10/7/1967
Tiago|P|Ribeiro|male|Rua do Congresso 890|TiagoPintoRibeiro@dayrep.com|(43) 6947-5856|10/30/1960
Luis|R|Martins|male|Caminho 3-G 1182|LuisRochaMartins@dayrep.com|(71) 5891-4488|2/21/1969
Gabriela|B|Gomes|female|Rua Santa Maria 1173|GabrielaBarrosGomes@rhyta.com|(85) 2089-3763|10/13/1992
Murilo|S|Ferreira|male|Rua Leopoldo Meyer 1818|MuriloSilvaFerreira@cuvox.de|(43) 3846-4855|9/7/1962
Davi|P|Azevedo|male|Avenida Maranhão 1238|DaviPintoAzevedo@jourrapide.com|(86) 3452-4613|5/31/1995
Caio|C|Ribeiro|male|Rua Ana Joaquina Aguiar 219|CaioCavalcantiRibeiro@armyspy.com|(19) 3902-9305|2/14/1974
Bianca|C|Ribeiro|female|Rua Cezário Domingues 1040|BiancaCarvalhoRibeiro@cuvox.de|(15) 9182-7578|10/13/1971
Miguel|C|Cunha|male|Avenida Elisio Galdino Sobrinho 1477|MiguelCarvalhoCunha@einrot.com|(12) 4918-2675|3/2/1993
Luan|C|Lima|male|Rua Frei Thiago Lucchese 896|LuanCostaLima@gustr.com|(42) 6534-2515|9/27/1980
Isabelle|M|Fernandes|female|Rua Israel 1299|IsabelleMeloFernandes@jourrapide.com|(27) 2034-2144|5/4/1993
Caio|S|Correia|male|Rua 4 1343|CaioSantosCorreia@cuvox.de|(85) 5128-9072|7/31/1991
Laura|M|Martins|female|Rua Mauro César do Nascimento 1381|LauraMeloMartins@dayrep.com|(24) 3849-4252|4/25/1963
Sofia|A|Ferreira|female|Rua Roberto Sardinha 213|SofiaAlvesFerreira@armyspy.com|(17) 9351-4603|10/14/1996
Luiza|B|Ribeiro|female|Rua Deonísio Chequeti 1865|LuizaBarrosRibeiro@fleckens.hu|(47) 6650-7741|1/19/1961
Luiza|D|Lima|female|Rua I 1858|LuizaDiasLima@cuvox.de|(33) 9709-6816|3/12/1989
Danilo|C|Ribeiro|male|Rua Pernambuco 346|DaniloCastroRibeiro@teleworm.us|(27) 6993-5980|5/16/1970
Diogo|C|Barros|male|Rua Cinco 1945|DiogoCorreiaBarros@armyspy.com|(65) 2016-7055|7/20/1966
Bianca|A|Almeida|female|Rua Agrimensor José de Brito 627|BiancaAlvesAlmeida@dayrep.com|(83) 7674-5624|5/17/1976
Fábio|C|Pereira|male|Rua Americana 1107|FabioCostaPereira@fleckens.hu|(19) 5627-5712|4/23/1996
Emilly|S|Alves|female|Rua Aloísio Borges 1810|EmillySousaAlves@armyspy.com|(82) 8398-6000|1/25/1964
Vinicius|G|Correia|male|Rua Pequizeiro 1094|ViniciusGoncalvesCorreia@superrito.com|(61) 4183-3720|3/2/1991
Beatriz|R|Souza|female|Travessa Conselheiro Antônio 1913|BeatrizRibeiroSouza@dayrep.com|(51) 2562-8804|1/22/1996
Marisa|P|Barros|female|Rua Tristão de Ataide 1444|MarisaPereiraBarros@cuvox.de|(11) 5257-2928|3/1/1976
Caio|B|Cardoso|male|Rua Coronel Gervásio Lara 820|CaioBarrosCardoso@jourrapide.com|(31) 9447-7519|1/26/1965
Brenda|M|Goncalves|female|Rua Almirante Saldanha 1287|BrendaMeloGoncalves@teleworm.us|(21) 3264-4875|10/6/1976
André|S|Cunha|male|Rua Nespereira 172|AndreSouzaCunha@gustr.com|(11) 6826-2838|9/12/1986
Isabelle|S|Lima|female|Rua Martinho Armbruster 346|IsabelleSilvaLima@gustr.com|(19) 3456-9160|10/17/1967
Júlio|S|Pinto|male|Rua Santos Valis 223|JulioSantosPinto@rhyta.com|(21) 7624-5482|5/3/1968
Ryan|B|Gomes|male|Rua Barão do Rio Branco 268|RyanBarbosaGomes@cuvox.de|(67) 5819-6947|9/19/1968
Luis|O|Goncalves|male|Rua L 1077|LuisOliveiraGoncalves@armyspy.com|(18) 3509-7052|11/18/1977
Bruno|D|Melo|male|Travessa Um 1410|BrunoDiasMelo@einrot.com|(21) 6077-5843|3/30/1972
Nicole|M|Martins|female|Rua Doutor João Perestrelo 1415|NicoleMeloMartins@einrot.com|(21) 8453-3086|1/1/1959
Emilly|A|Cunha|female|Praça Tanguá 880|EmillyAlmeidaCunha@einrot.com|(31) 3637-4443|10/2/1965
Lara|P|Costa|female|Viela Manoel Moreira Passos 401|LaraPereiraCosta@rhyta.com|(11) 7933-8018|3/31/1995
Gabrielly|F|Alves|female|Jardim Castro Alves 1593|GabriellyFerreiraAlves@fleckens.hu|(71) 4609-4384|1/3/1969
Renan|C|Goncalves|male|Avenida Santa Rita 1429|RenanCastroGoncalves@jourrapide.com|(62) 4048-2915|8/23/1981
Aline|C|Silva|female|Rua Andrino Marcolino Bento 1488|AlineCavalcantiSilva@rhyta.com|(48) 9353-6840|10/11/1955
Enzo|S|Gomes|male|Rua Malaia 1627|EnzoSilvaGomes@teleworm.us|(11) 3855-7781|2/1/1973
Melissa|C|Ribeiro|female|Avenida Presidente Tancredo de Almeida Neves 1272|MelissaCastroRibeiro@jourrapide.com|(11) 9332-2992|9/29/1974
Clara|R|Cunha|female|Rua Picui 1415|ClaraRodriguesCunha@rhyta.com|(45) 8556-2243|10/25/1968
Isabella|R|Castro|female|Rua Professor José Fabrício de Oliveira 166|IsabellaRodriguesCastro@jourrapide.com|(84) 4139-2014|5/7/1982
Mariana|M|Dias|female|Travessa Carana 898|MarianaMartinsDias@jourrapide.com|(11) 5420-9353|12/12/1981
Tomás|S|Sousa|male|Rua Ary Guimarães 1723|TomasSouzaSousa@cuvox.de|(24) 9560-9122|9/24/1963
Samuel|F|Rodrigues|male|Rua Sete 1198|SamuelFerreiraRodrigues@einrot.com|(34) 7842-3138|12/3/1996
Carolina|G|Melo|female|Rua Oscar Alves Leão 596|CarolinaGomesMelo@superrito.com|(64) 7265-7461|2/9/1963
João|D|Castro|male|Rua Carlos Linck 1187|JoaoDiasCastro@gustr.com|(51) 3841-4080|6/6/1995
Mariana|G|Azevedo|female|Rua José de Freitas Guimarães 886|MarianaGomesAzevedo@gustr.com|(11) 3551-9041|10/8/1974
Douglas|A|Lima|male|Rua Edenilda M. Leal 1672|DouglasAzevedoLima@dayrep.com|(41) 7934-8741|3/30/1972
Igor|O|Melo|male|Rua José Paulino Filho 1017|IgorOliveiraMelo@einrot.com|(83) 6920-4405|2/5/1985
Raissa|R|Almeida|female|Rua Washington Luiz 1965|RaissaRibeiroAlmeida@armyspy.com|(41) 5556-7679|12/20/1967
Guilherme|M|Santos|male|Rua Ceará 1689|GuilhermeMeloSantos@fleckens.hu|(55) 5215-5459|11/13/1968
Diogo|C|Ferreira|male|Avenida Presidente Kennedy 1016|DiogoCardosoFerreira@teleworm.us|(24) 7785-9306|3/15/1970
Guilherme|L|Ribeiro|male|Rodovia Lúcio Meira 190|GuilhermeLimaRibeiro@armyspy.com|(24) 4069-5618|12/24/1974
Kai|B|Araujo|male|Estrada Arlindo Torso 331|KaiBarrosAraujo@armyspy.com|(11) 9898-6350|5/11/1992
Guilherme|S|Barros|male|Vila Barros Franco 1811|GuilhermeSousaBarros@einrot.com|(24) 7516-8353|9/2/1974
Fernanda|M|Pinto|female|Quadra QNE 18 423|FernandaMartinsPinto@cuvox.de|(61) 6374-4613|5/28/1957
Letícia|F|Costa|female|Rua Joaquim Custódio Dias 1469|LeticiaFerreiraCosta@rhyta.com|(19) 7784-6598|11/14/1988
Renan|R|Goncalves|male|Rua Primeiro de Dezembro 449|RenanRibeiroGoncalves@jourrapide.com|(71) 6724-5205|5/26/1972
Vinícius|C|Cavalcanti|male|Travessa São Paulo 999|ViniciusCardosoCavalcanti@gustr.com|(71) 8991-8505|1/21/1990
Arthur|S|Carvalho|male|Rua Atílio Rodrigues Cardoso 413|ArthurSilvaCarvalho@superrito.com|(41) 9052-7801|2/25/1991
Eduarda|S|Cunha|female|Rua Augusto de Oliveira e Silva 94|EduardaSilvaCunha@fleckens.hu|(12) 2619-5490|3/11/1995
Kauê|D|Melo|male|Rua Vasco Mascarenhas 1696|KaueDiasMelo@gustr.com|(21) 9196-9912|11/20/1969
Nicolash|C|Ribeiro|male|Rua Ângelo Colacino 478|NicolashCunhaRibeiro@cuvox.de|(14) 5421-8956|2/1/1993
Gabriela|F|Goncalves|female|Rua G 1104|GabrielaFernandesGoncalves@rhyta.com|(21) 6123-6573|5/25/1981
João|M|Cavalcanti|male|Rua Jaguapita 1540|JoaoMartinsCavalcanti@einrot.com|(75) 9036-3325|8/27/1987
Júlio|M|Souza|male|Rua Doutor Bozano 1859|JulioMeloSouza@einrot.com|(55) 9812-9080|4/18/1992
Aline|R|Souza|female|Rua Alfarroba 1815|AlineRibeiroSouza@fleckens.hu|(81) 9317-5863|11/17/1996
Leonardo|L|Rodrigues|male|Rua Jairo França 1317|LeonardoLimaRodrigues@cuvox.de|(11) 2885-5753|8/8/1980
Alex|R|Rodrigues|male|Rua Edmundo 1211|AlexRochaRodrigues@teleworm.us|(21) 8823-9769|2/28/1991
Julian|A|Carvalho|male|Travessa Frei Dário 105|JulianAraujoCarvalho@rhyta.com|(85) 4896-9112|12/26/1958
Thiago|L|Castro|male|Rua Jaime Jacob de Ávila 1044|ThiagoLimaCastro@teleworm.us|(34) 5267-7763|8/25/1986
Otávio|P|Barbosa|male|Praça Professora Enid R. C. Degan 777|OtavioPintoBarbosa@armyspy.com|(19) 9009-4723|7/17/1968
Isabela|R|Lima|female|Rua Doutor Virgílio Machado 1733|IsabelaRibeiroLima@superrito.com|(55) 3251-4163|2/21/1986
Erick|R|Martins|male|Rua Júlio de Castilhos 1637|ErickRibeiroMartins@rhyta.com|(51) 5682-9084|11/13/1978
Larissa|C|Correia|female|Rua Coronel Jorge Ferreira de Araújo 1629|LarissaCostaCorreia@einrot.com|(81) 3699-7693|5/22/1961
Clara|C|Souza|female|Rua Arroio da Manteiga 1035|ClaraCastroSouza@dayrep.com|(51) 7415-5546|8/5/1983
Kai|S|Dias|male|Rua José Mendes 799|KaiSantosDias@jourrapide.com|(67) 8906-6121|7/9/1965
Luís|B|Melo|male|Rua Professor Carlos Alchorne 565|LuisBarrosMelo@teleworm.us|(81) 5491-3070|7/20/1966
Luís|R|Oliveira|male|Rua Dez 1482|LuisRochaOliveira@armyspy.com|(37) 9054-9776|4/10/1981
Manuela|C|Barros|female|Rua Maria Batista de Medeiros 1798|ManuelaCastroBarros@teleworm.us|(83) 4655-2212|9/17/1993
Victor|S|Rocha|male|Rua Ana Severina Rosa 192|VictorSantosRocha@cuvox.de|(31) 5125-9396|1/20/1984
Breno|A|Silva|male|Rua Campos Floridos 1838|BrenoAlmeidaSilva@gustr.com|(11) 4448-5901|2/25/1970
Douglas|A|Cavalcanti|male|Rua Paulo VI 906|DouglasAzevedoCavalcanti@fleckens.hu|(49) 6380-4064|9/8/1986
Marina|C|Lima|female|Rua Antônio Carlos de Camargo Vianna 602|MarinaCardosoLima@einrot.com|(11) 5947-4358|12/10/1984
Estevan|D|Almeida|male|Rua 3 504|EstevanDiasAlmeida@cuvox.de|(85) 2322-9812|9/24/1970
Bianca|C|Azevedo|female|Rua dos Canários 1172|BiancaCostaAzevedo@gustr.com|(11) 8825-9746|2/21/1984
Bruno|C|Barros|male|Rua Professor José de Almeida Júnior 1443|BrunoCavalcantiBarros@rhyta.com|(83) 4320-5622|6/25/1958
Amanda|O|Goncalves|female|Rua Barreirinho 344|AmandaOliveiraGoncalves@dayrep.com|(65) 6842-9042|4/11/1972
Kai|A|Costa|male|Rua Carlos Drummond de Andrade 587|KaiAlvesCosta@armyspy.com|(45) 6007-2590|5/14/1989
Leonardo|F|Silva|male|Rua Aracy Barcelos Fonseca 401|LeonardoFernandesSilva@einrot.com|(51) 9423-6684|12/20/1976
Julieta|S|Ribeiro|female|Rua Padre Anchieta 1712|JulietaSouzaRibeiro@dayrep.com|(94) 8764-3105|9/3/1975
Julian|A|Oliveira|male|Rua Platina 1024|JulianAzevedoOliveira@einrot.com|(27) 7296-3712|8/29/1991
Alice|G|Alves|female|Rua Jacy Campos Neto 1457|AliceGoncalvesAlves@teleworm.us|(64) 6566-3098|3/3/1985
Mateus|A|Rocha|male|Rua Quinze 1765|MateusAzevedoRocha@superrito.com|(11) 6115-4103|12/22/1971
Kaua|A|Costa|male|Rua Marcia 1173|KauaAlmeidaCosta@jourrapide.com|(21) 7093-6307|9/18/1963
Isabelle|G|Carvalho|female|Quadra SQS 116 Bloco E 1776|IsabelleGoncalvesCarvalho@rhyta.com|(61) 9914-2503|10/10/1959
Bruna|R|Sousa|female|Rua Pereira Coutinho 1849|BrunaRochaSousa@jourrapide.com|(11) 2423-2539|2/21/1997
Evelyn|A|Barbosa|female|Rua das Dálias 375|EvelynAlvesBarbosa@gustr.com|(95) 4726-8292|5/28/1986
Mateus|C|Gomes|male|Rua Trinta e Sete 1330|MateusCorreiaGomes@jourrapide.com|(81) 2416-8640|10/1/1970
Aline|S|Fernandes|female|Avenida Alberto Araújo Arruda 1290|AlineSousaFernandes@armyspy.com|(67) 5031-9753|12/28/1995
Estevan|B|Costa|male|Avenida Urucarana 920|EstevanBarbosaCosta@gustr.com|(21) 5412-9753|1/26/1993
Marina|B|Gomes|female|Travessa Túlio Margotto 656|MarinaBarrosGomes@teleworm.us|(27) 6932-5884|2/4/1973
Manuela|R|Azevedo|female|Parque André de Blois Montoro 1662|ManuelaRibeiroAzevedo@fleckens.hu|(11) 9886-5024|12/14/1973
Rafael|S|Correia|male|Rua dos Bolivianos 1497|RafaelSilvaCorreia@armyspy.com|(11) 5613-3578|2/1/1973
Danilo|C|Martins|male|Avenida Nossa Senhora do Monte Serrat 47|DaniloCostaMartins@superrito.com|(11) 3851-5328|5/25/1983
Murilo|G|Alves|male|Rua Paraguassu 713|MuriloGomesAlves@einrot.com|(62) 6920-2909|9/18/1989
Manuela|D|Carvalho|female|Rua Nova Filadelfia 456|ManuelaDiasCarvalho@teleworm.us|(84) 5040-8887|4/11/1996
Sophia|S|Cavalcanti|female|Rua Copacabana da Massaranduba 998|SophiaSousaCavalcanti@jourrapide.com|(71) 3185-3791|4/27/1974
Beatrice|C|Martins|female|Rua Guarani 1259|BeatriceCarvalhoMartins@jourrapide.com|(71) 8164-9420|3/10/1958
Bruna|D|Cunha|female|Estrada Serra do Quartel 864|BrunaDiasCunha@gustr.com|(11) 5985-9371|10/19/1959
Danilo|C|Alves|male|Rua Professor Roberto Cavalheiro Brisolla 123|DaniloCastroAlves@fleckens.hu|(11) 2466-7033|10/1/1993
Davi|C|Araujo|male|Avenida Antônio Salvador Zen 1264|DaviCardosoAraujo@gustr.com|(16) 7124-7446|9/7/1972
Camila|C|Santos|female|Rua Mathilde Benner 303|CamilaCardosoSantos@teleworm.us|(47) 9188-7940|9/7/1971
Carolina|S|Azevedo|female|Rua Jamburana 586|CarolinaSouzaAzevedo@superrito.com|(11) 4273-4837|10/31/1968
Thaís|O|Almeida|female|Rua General Portinho 165|ThaisOliveiraAlmeida@teleworm.us|(51) 8080-8888|3/4/1991
Livia|G|Barbosa|female|Rua Pioneiro Bessa 457|LiviaGoncalvesBarbosa@gustr.com|(94) 7990-6496|6/26/1993
Vinicius|C|Araujo|male|Rua dos Amarantos 601|ViniciusCardosoAraujo@armyspy.com|(12) 5253-5806|11/13/1955
Luís|S|Souza|male|Rua Cruzília 850|LuisSousaSouza@jourrapide.com|(11) 6377-3854|12/4/1975
Marina|R|Goncalves|female|Praça Manoel Gomes 1838|MarinaRodriguesGoncalves@superrito.com|(15) 5766-7691|6/12/1990
Rodrigo|S|Costa|male|Rua C-0243 1903|RodrigoSilvaCosta@rhyta.com|(62) 6024-3268|9/3/1965
Manuela|P|Almeida|female|Rua São Martiniano 807|ManuelaPintoAlmeida@jourrapide.com|(21) 8803-5850|5/10/1975
Livia|A|Gomes|female|Alameda Periquito 609|LiviaAlmeidaGomes@cuvox.de|(11) 9962-8913|8/4/1981
Davi|C|Rodrigues|male|2ª Travessa Um 1286|DaviCarvalhoRodrigues@cuvox.de|(81) 2316-9742|3/29/1965
Breno|F|Barros|male|Rua C 1895|BrenoFerreiraBarros@gustr.com|(21) 9024-5200|2/6/1984
Raissa|R|Cavalcanti|female|Rua Juiz João Navarro Filho 1658|RaissaRochaCavalcanti@rhyta.com|(83) 7208-4484|10/31/1975
Miguel|O|Azevedo|male|Travessa Belo Horizonte 1339|MiguelOliveiraAzevedo@armyspy.com|(71) 5534-9516|7/3/1993
Lara|B|Pinto|female|Rua Tiradentes 1612|LaraBarrosPinto@gustr.com|(27) 2660-7706|11/21/1975
Kaua|C|Barros|male|Rua São João Del Rey 1037|KauaCavalcantiBarros@dayrep.com|(16) 9111-9674|12/26/1964
Thaís|A|Goncalves|female|Rua Onze 542|ThaisAlmeidaGoncalves@gustr.com|(11) 4349-8760|2/21/1962
Sarah|F|Araujo|female|Rua Oito 1061|SarahFerreiraAraujo@rhyta.com|(51) 6590-3145|3/8/1957
Vitor|A|Cardoso|male|Avenida Brasil 1430|VitorAzevedoCardoso@superrito.com|(37) 6449-3492|9/11/1981
Victor|R|Dias|male|Rua Marquês de Queluz 1712|VictorRodriguesDias@dayrep.com|(51) 7583-8065|7/14/1978
Júlia|S|Silva|female|Rua Francisco de Paula 401|JuliaSouzaSilva@teleworm.us|(71) 9136-4378|8/28/1992
Vitór|G|Dias|male|Rua Lauro Luchesi 573|VitorGomesDias@rhyta.com|(11) 6016-6762|1/21/1990
Felipe|D|Correia|male|Rua Mauá 1364|FelipeDiasCorreia@jourrapide.com|(21) 4301-2890|2/19/1991
Gabrielle|G|Carvalho|female|Rua Cento e Quarenta e Um 1792|GabrielleGoncalvesCarvalho@armyspy.com|(81) 3810-2964|11/7/1977
Julieta|C|Silva|female|Quadra EQNP 15/19 1535|JulietaCorreiaSilva@teleworm.us|(61) 4887-2302|3/14/1990
Letícia|C|Silva|female|Rua Otávio Barbosa da Silva 545|LeticiaCastroSilva@fleckens.hu|(27) 7168-9310|10/27/1988
Kai|R|Sousa|male|Rua das Caneleiras 1597|KaiRibeiroSousa@einrot.com|(98) 4164-8873|2/9/1956
Miguel|R|Correia|male|Rua José Maurício Borges 338|MiguelRibeiroCorreia@teleworm.us|(12) 2675-7826|8/12/1969
Carlos|D|Costa|male|Rua João Pagnan 700|CarlosDiasCosta@superrito.com|(43) 3056-8643|12/3/1990
Pedro|D|Rocha|male|Quadra QNL 06 Conjunto J 1339|PedroDiasRocha@armyspy.com|(61) 9443-6183|9/17/1984
Luan|O|Carvalho|male|Rua Osório Ignacio Pinheiro 1125|LuanOliveiraCarvalho@gustr.com|(54) 5608-9515|6/22/1971
Kauan|R|Costa|male|Rua Carauri 1867|KauanRibeiroCosta@teleworm.us|(21) 8484-2660|11/4/1961
Leonardo|S|Ferreira|male|Rua do Canal 1485|LeonardoSousaFerreira@gustr.com|(21) 7177-2927|5/17/1970
Gabrielly|S|Pinto|female|Rua Maravilhas 1745|GabriellySantosPinto@jourrapide.com|(31) 7673-5635|8/14/1968
Martim|C|Barros|male|Rua Geraldo Martins de Oliveira 918|MartimCorreiaBarros@armyspy.com|(11) 4497-2033|6/6/1977
Vitória|F|Fernandes|female|Rua Kobe 593|VitoriaFerreiraFernandes@rhyta.com|(11) 9936-8067|3/9/1982
Kauan|A|Martins|male|Rua Santa Rosa do Viterbo 296|KauanAzevedoMartins@superrito.com|(11) 2854-2150|1/2/1991
Júlio|B|Pinto|male|Travessa Boa Fé 1416|JulioBarbosaPinto@einrot.com|(71) 4697-2160|11/16/1995
Camila|B|Ferreira|female|Estrada do Caracu 1359|CamilaBarrosFerreira@armyspy.com|(16) 2764-8372|1/25/1988
Matilde|L|Cunha|female|Estrada Presidente Sodré 1839|MatildeLimaCunha@dayrep.com|(24) 9580-5699|3/20/1982
Luiz|P|Martins|male|Rua Irmã Carmelita de Jesus 886|LuizPintoMartins@rhyta.com|(24) 4521-6196|5/9/1970
Evelyn|A|Melo|female|Rua Luetgen 72|EvelynAlvesMelo@rhyta.com|(51) 7326-9314|9/7/1996
Diego|S|Lima|male|Travessa Nossa Senhora das Graças 1199|DiegoSouzaLima@gustr.com|(21) 5399-3163|10/14/1958
Giovanna|A|Souza|female|Rua Hugo José Corsetti 1863|GiovannaAlmeidaSouza@jourrapide.com|(54) 3644-7322|3/22/1961
Vinicius|C|Pereira|male|Quadra 54 980|ViniciusCunhaPereira@cuvox.de|(61) 7099-6539|1/22/1988
Erick|S|Martins|male|Rua George Conus 848|ErickSouzaMartins@jourrapide.com|(11) 7499-3637|9/20/1975
Carolina|R|Carvalho|female|Beco Joana D'arc 1794|CarolinaRibeiroCarvalho@teleworm.us|(31) 8094-9176|2/25/1964
Vinícius|B|Martins|male|Rua São Pedro 789|ViniciusBarrosMartins@dayrep.com|(47) 7540-2188|6/11/1992
Raissa|B|Cunha|female|Rua Álvaro de Brito 732|RaissaBarrosCunha@rhyta.com|(79) 4706-7550|3/25/1973
Gabrielly|G|Almeida|female|Rua Quatro 87|GabriellyGomesAlmeida@fleckens.hu|(31) 8999-5883|1/21/1960
Carla|C|Cunha|female|Rua Sidnei Perin 845|CarlaCarvalhoCunha@einrot.com|(19) 8660-9639|1/17/1986
Gabriel|B|Pinto|male|Rua Benedito Walter dos Santos 863|GabrielBarrosPinto@einrot.com|(19) 9581-9318|12/30/1964
Breno|G|Castro|male|Rua São Paulo 939|BrenoGoncalvesCastro@fleckens.hu|(94) 9177-4592|12/30/1960
Gabriel|F|Souza|male|Rua Francisco Porto 1856|GabrielFerreiraSouza@gustr.com|(21) 3382-9141|9/24/1972
Vinicius|P|Fernandes|male|Quadra Quadra 027 688|ViniciusPintoFernandes@rhyta.com|(61) 2135-8363|5/9/1992
Melissa|A|Cavalcanti|female|Rua Gaivota 1540|MelissaAlvesCavalcanti@armyspy.com|(44) 6669-9923|10/20/1977
Bianca|A|Ferreira|female|Rua Francisco Lopes da Silva 766|BiancaAzevedoFerreira@fleckens.hu|(67) 4007-6768|1/28/1989
Enzo|A|Goncalves|male|Rua João Madeira 760|EnzoAlmeidaGoncalves@jourrapide.com|(14) 9637-6870|3/1/1967
Mariana|O|Dias|female|Rua Cristo Redentor 469|MarianaOliveiraDias@einrot.com|(37) 7419-5340|12/8/1974
Luana|M|Barbosa|female|Rua C 717|LuanaMeloBarbosa@armyspy.com|(12) 2581-3720|6/15/1967
Larissa|D|Pinto|female|Rua Hipólito Caron 1792|LarissaDiasPinto@armyspy.com|(11) 8978-3142|3/30/1985
Matilde|F|Araujo|female|Rua Goiás 34|MatildeFernandesAraujo@fleckens.hu|(42) 2488-4418|8/3/1990
Melissa|M|Correia|female|Rua Carupenha 1991|MelissaMeloCorreia@superrito.com|(75) 7578-7203|2/7/1959
Tiago|M|Cunha|male|Avenida Ayrton Senna 1575|TiagoMartinsCunha@rhyta.com|(21) 7504-2095|4/4/1956
Joao|P|Rodrigues|male|Rua Manoel Bandeira 273|JoaoPereiraRodrigues@einrot.com|(12) 3383-8807|11/19/1960
Paulo|C|Fernandes|male|Rua Canina 1845|PauloCastroFernandes@einrot.com|(21) 8819-8910|9/4/1989
Caio|S|Gomes|male|Rua Félix Ferreira Torres 245|CaioSouzaGomes@rhyta.com|(18) 9197-7814|6/10/1960
Miguel|C|Souza|male|Rua Quatro 1344|MiguelCunhaSouza@gustr.com|(69) 2923-4842|1/29/1995
José|C|Sousa|male|Rua Apóstolo André 536|JoseCunhaSousa@rhyta.com|(11) 2542-8173|11/18/1992
Marcos|P|Lima|male|Rua Pioneiro Edvir Ferreira de Araújo 1074|MarcosPereiraLima@einrot.com|(44) 4308-6091|1/8/1969
Alice|R|Alves|female|Estrada Serra Azul 396|AliceRochaAlves@rhyta.com|(11) 5751-2470|4/23/1961
Matilde|F|Oliveira|female|Travessa Primula 168|MatildeFerreiraOliveira@armyspy.com|(44) 3272-2909|9/28/1957
Luana|F|Cavalcanti|female|Rua Rio Sena 554|LuanaFernandesCavalcanti@fleckens.hu|(31) 9855-6902|11/11/1962
Davi|C|Correia|male|Rua Masatoshi Tominaga 1017|DaviCostaCorreia@teleworm.us|(11) 6533-3457|1/6/1991
Leonardo|A|Gomes|male|Rua Agenôr de Abreu Peixoto 1526|LeonardoAzevedoGomes@dayrep.com|(81) 8555-2886|2/18/1971
Aline|P|Rodrigues|female|Rua Ferdinando Rutini 1506|AlinePereiraRodrigues@rhyta.com|(11) 4516-6849|2/22/1997
Vitór|P|Rodrigues|male|Travessa Terceira 1642|VitorPintoRodrigues@fleckens.hu|(91) 2607-7060|8/22/1971
Vitór|M|Pinto|male|Avenida Governador Adolfo Konder 1062|VitorMartinsPinto@superrito.com|(47) 3288-9645|8/13/1963
Estevan|S|Cunha|male|Quadra Quadra 23 323|EstevanSilvaCunha@cuvox.de|(61) 3525-9446|3/3/1964
Pedro|F|Rocha|male|Quadra QR 107 Conjunto 06 1489|PedroFernandesRocha@dayrep.com|(61) 2085-4033|8/13/1977
Joao|C|Gomes|male|Avenida Japaratinga 1930|JoaoCostaGomes@rhyta.com|(62) 8245-5375|9/22/1996
Rafaela|R|Costa|female|Rua Osvaldo Aranha 960|RafaelaRodriguesCosta@gustr.com|(18) 7561-2888|3/14/1989
Kaua|C|Castro|male|Rua Duque de Caxias 1854|KauaCunhaCastro@gustr.com|(44) 8126-9426|8/8/1994
Cauã|A|Cavalcanti|male|Rua Marina Barreto 1411|CauaAlvesCavalcanti@rhyta.com|(21) 2610-4314|2/1/1994
Daniel|C|Souza|male|Rua 477 1147|DanielCarvalhoSouza@fleckens.hu|(48) 4480-7361|5/21/1970
Gustavo|C|Costa|male|Rua Daniela 20|GustavoCunhaCosta@teleworm.us|(11) 7772-3177|6/13/1961
Julieta|A|Ferreira|female|Rua Nhambiquara 1146|JulietaAlvesFerreira@dayrep.com|(65) 9387-2627|7/4/1958
Julia|P|Ferreira|female|Quadra 806 Sul Alameda 10 A 846|JuliaPereiraFerreira@rhyta.com|(63) 3785-5766|1/26/1991
José|S|Alves|male|Rua Espanha 1878|JoseSouzaAlves@jourrapide.com|(11) 6320-5693|6/9/1989
Sophia|R|Correia|female|Rua Gonzaga de Campos 321|SophiaRibeiroCorreia@einrot.com|(11) 5179-3095|9/5/1980
Douglas|D|Carvalho|male|Rua das Cruzadas 1821|DouglasDiasCarvalho@einrot.com|(81) 9913-2696|12/19/1979
Julieta|R|Melo|female|Rua José Francisco de Paula 1142|JulietaRochaMelo@rhyta.com|(12) 9473-9959|3/26/1979
Tomás|B|Silva|male|Avenida Marechal Castelo Branco 280|TomasBarbosaSilva@einrot.com|(86) 5588-9843|5/6/1976
Letícia|C|Ferreira|female|Avenida Delfim Moreira 1068|LeticiaCorreiaFerreira@superrito.com|(21) 6109-8419|5/18/1984
Julia|S|Dias|female|Rua Euclides da Cunha 1436|JuliaSouzaDias@rhyta.com|(27) 4810-6869|7/17/1992
Evelyn|F|Gomes|female|Rua Aracaju 957|EvelynFerreiraGomes@einrot.com|(11) 8495-4856|5/22/1969
Otávio|M|Almeida|male|Rua Acácias 401|OtavioMeloAlmeida@einrot.com|(37) 6192-8576|11/28/1971
André|C|Costa|male|Rua Coração de Jesus 275|AndreCorreiaCosta@gustr.com|(33) 2262-2239|11/15/1996
Amanda|C|Alves|female|Rua José de Faria 1458|AmandaCardosoAlves@cuvox.de|(12) 4539-6259|2/27/1985
Martim|S|Cardoso|male|Avenida Nilo Peçanha 643|MartimSousaCardoso@rhyta.com|(21) 9735-8670|5/23/1983
Rafael|C|Pinto|male|Estrada da Barroca Funda 1140|RafaelCostaPinto@gustr.com|(11) 6645-7964|10/10/1972
Fernanda|S|Lima|female|Rua José Rodrigues Viana 14|FernandaSouzaLima@superrito.com|(73) 7609-9980|5/20/1960
Nicolas|R|Almeida|male|Rua João Conceição Nunes 574|NicolasRibeiroAlmeida@dayrep.com|(55) 2080-2762|3/8/1968
Emily|C|Rodrigues|female|Rua Francisco Luís Ferreira 1445|EmilyCarvalhoRodrigues@gustr.com|(17) 2262-4620|4/12/1969
Breno|M|Barros|male|Rua Francisco Cardella 448|BrenoMeloBarros@einrot.com|(19) 7822-2501|6/29/1996
Melissa|S|Sousa|female|Rua Lino Marques 528|MelissaSouzaSousa@jourrapide.com|(32) 8001-3166|4/3/1992
Marisa|R|Barros|female|Travessa Paranoá 750|MarisaRibeiroBarros@gustr.com|(85) 5546-3911|5/28/1979
Gabrielly|G|Santos|female|Rua Juranda 698|GabriellyGomesSantos@gustr.com|(21) 8516-8863|10/30/1965
Kauã|B|Ribeiro|male|Vila Balduíno Freire 758|KauaBarbosaRibeiro@teleworm.us|(85) 9417-6212|1/4/1974
Gabrielle|L|Barros|female|Avenida Doutor Antônio Alves Passig 940|GabrielleLimaBarros@armyspy.com|(16) 5797-5829|8/20/1974
Aline|C|Cunha|female|Avenida Guaca 1750|AlineCastroCunha@einrot.com|(11) 2905-7264|4/24/1969
Beatrice|S|Cunha|female|Rua Nelson Ferraz da Silva 291|BeatriceSilvaCunha@jourrapide.com|(19) 9616-6914|11/11/1985
Leonor|B|Lima|female|Rua Cinquenta e Seis 325|LeonorBarbosaLima@dayrep.com|(81) 8662-9269|9/3/1979
Tomás|B|Azevedo|male|Via Antônio Machado Sant'Anna 853|TomasBarrosAzevedo@teleworm.us|(16) 4787-5139|3/5/1980
Sophia|A|Silva|female|Rua Eduardo Tomanik 197|SophiaAlvesSilva@dayrep.com|(11) 6260-8306|4/18/1974
Murilo|C|Oliveira|male|Rua A 973|MuriloCardosoOliveira@einrot.com|(24) 8082-8185|12/19/1988
Bruna|A|Rocha|female|Rua Aparecida do Jardim 1665|BrunaAlvesRocha@superrito.com|(85) 8273-3825|11/21/1970
Ana|C|Alves|female|Travessa Paraguai 780|AnaCardosoAlves@teleworm.us|(81) 8981-5350|1/25/1977
Alex|G|Rocha|male|Rua Joaquim Ferreira Cruz 154|AlexGoncalvesRocha@teleworm.us|(34) 7331-8292|7/22/1996
Camila|C|Cunha|female|Rua Nice 1792|CamilaCastroCunha@teleworm.us|(31) 3607-9848|5/7/1986
Kauã|S|Almeida|male|Rua do Jasmim 1783|KauaSantosAlmeida@cuvox.de|(11) 7197-8987|4/6/1977
Carolina|S|Goncalves|female|Rua Edmundo Reis Frias Júnior 775|CarolinaSantosGoncalves@einrot.com|(11) 5119-2889|12/13/1982
Felipe|C|Castro|male|Rua Ninho de Imares 77|FelipeCarvalhoCastro@dayrep.com|(11) 4511-8649|1/6/1972
Matheus|G|Azevedo|male|Rua Domingos da Veiga 947|MatheusGoncalvesAzevedo@einrot.com|(85) 3939-6243|12/9/1969
Pedro|O|Gomes|male|Rua Nuno Tristão 1652|PedroOliveiraGomes@dayrep.com|(31) 8462-3429|3/28/1997
Breno|A|Pinto|male|Rua Capitão Arnaldo Valente 1442|BrenoAlvesPinto@cuvox.de|(13) 7721-5485|9/15/1983
Pedro|A|Pinto|male|Rua F 453|PedroAzevedoPinto@superrito.com|(85) 4522-5246|4/24/1966
Bruna|C|Martins|female|Alameda Honolulu 1117|BrunaCastroMartins@fleckens.hu|(11) 7438-5806|2/23/1971
Igor|O|Pinto|male|Rua Professor Ferdinando Borla 1756|IgorOliveiraPinto@gustr.com|(11) 8678-5906|6/26/1995
Ana|G|Rodrigues|female|Rua Vila Velha 417|AnaGomesRodrigues@dayrep.com|(27) 5440-6532|10/29/1983
Letícia|P|Cavalcanti|female|Rua Padre Manoel Bernardes 1994|LeticiaPintoCavalcanti@superrito.com|(31) 8282-6377|4/7/1965
Gabrielle|M|Rodrigues|female|Viela dos Ferroviários 1480|GabrielleMeloRodrigues@teleworm.us|(11) 8099-5997|11/26/1972
Alice|M|Goncalves|female|Rua da Linha 1980|AliceMeloGoncalves@cuvox.de|(21) 5775-4344|7/4/1957
Sarah|A|Cavalcanti|female|Rua Moacyr Gaia 346|SarahAlmeidaCavalcanti@cuvox.de|(34) 4621-7830|3/11/1969
Gabriela|A|Sousa|female|Quadra 108 Sul Alameda 10 407|GabrielaAlmeidaSousa@jourrapide.com|(63) 2685-7990|8/18/1990
Emily|A|Dias|female|Rua Nigata 1128|EmilyAzevedoDias@jourrapide.com|(11) 9464-3680|9/15/1970
Gabrielly|A|Barbosa|female|Rua Luiz Luz 151|GabriellyAlmeidaBarbosa@armyspy.com|(51) 8838-2195|3/10/1956
Erick|C|Oliveira|male|Rua Um 1938|ErickCavalcantiOliveira@armyspy.com|(14) 5528-7665|1/22/1963
Rafaela|B|Carvalho|female|Rua Primo Bastistone 1551|RafaelaBarrosCarvalho@dayrep.com|(11) 7481-7394|12/3/1973
Renan|S|Castro|male|Rua Júlio Orthmann 520|RenanSouzaCastro@cuvox.de|(47) 8819-2368|7/8/1995
Ryan|O|Ribeiro|male|Rua Juana Samary 1740|RyanOliveiraRibeiro@armyspy.com|(11) 3082-2966|5/28/1997
Gabrielle|C|Dias|female|Rua Engenheiro João Pimenta Bastos 1432|GabrielleCunhaDias@einrot.com|(71) 6813-5438|1/5/1966
Luiza|C|Martins|female|Praça do Britador 1193|LuizaCorreiaMartins@gustr.com|(64) 4304-8934|8/29/1977
Sarah|B|Souza|female|Rua Eid Abou Saad 1227|SarahBarbosaSouza@armyspy.com|(44) 6826-8365|12/14/1977
Eduardo|C|Sousa|male|Rua Itapiranga 1606|EduardoCastroSousa@dayrep.com|(31) 5552-4216|2/10/1984
Thiago|C|Cunha|male|Rua Caracas 818|ThiagoCarvalhoCunha@teleworm.us|(21) 5202-2286|11/14/1963
Julian|B|Rodrigues|male|Rua Bocaina 1326|JulianBarbosaRodrigues@gustr.com|(11) 7122-9210|9/13/1964
Daniel|M|Carvalho|male|Rua 302 102|DanielMeloCarvalho@fleckens.hu|(64) 6521-7195|12/21/1983
Sofia|O|Barbosa|female|Quadra EQNP 14/18 Módulo H 1013|SofiaOliveiraBarbosa@teleworm.us|(61) 9769-7975|10/25/1993
Daniel|C|Fernandes|male|Rua Ezequiel Benedito Silva 133|DanielCunhaFernandes@armyspy.com|(19) 9064-2250|9/13/1978
Bianca|A|Cavalcanti|female|Travessa União 257|BiancaAraujoCavalcanti@gustr.com|(21) 7921-3346|11/18/1974
Fernanda|P|Souza|female|Rua 3 1449|FernandaPereiraSouza@armyspy.com|(62) 7668-5457|5/9/1997
Laura|S|Almeida|female|Rua Deodoro da Fonseca 349|LauraSouzaAlmeida@teleworm.us|(81) 6819-2670|2/1/1993
Marina|R|Sousa|female|Rodovia PR-340 Saída Pará Castrolanda 1752|MarinaRibeiroSousa@rhyta.com|(42) 6885-3907|8/11/1957
Estevan|O|Correia|male|Rua Raul Pompéia 56|EstevanOliveiraCorreia@dayrep.com|(51) 6311-4271|5/12/1987
Lara|F|Silva|female|Rua da Olaria 556|LaraFernandesSilva@einrot.com|(11) 5801-7500|12/15/1961
Nicole|C|Sousa|female|Rua Treze de Maio 643|NicoleCunhaSousa@rhyta.com|(62) 7747-4183|8/30/1968
Leila|B|Pereira|female|Rua Juruá 1026|LeilaBarrosPereira@dayrep.com|(22) 8237-4881|11/2/1960
Leila|S|Santos|female|Rua Ponta Porã 1484|LeilaSilvaSantos@dayrep.com|(81) 8943-3435|12/25/1963
Luan|M|Cardoso|male|Rua Ataliba Reis 1755|LuanMartinsCardoso@rhyta.com|(11) 3421-5462|2/8/1965
Paulo|C|Gomes|male|Travessa Turiassu 344|PauloCarvalhoGomes@gustr.com|(18) 5290-5562|4/27/1979
Alex|S|Azevedo|male|Rua Vinte e Cinco 66|AlexSouzaAzevedo@cuvox.de|(31) 6526-9128|12/21/1966
Thiago|C|Goncalves|male|Avenida Presidente Juscelino Kubitschek 1867|ThiagoCastroGoncalves@gustr.com|(31) 6402-9469|1/8/1964
Vitór|A|Carvalho|male|Rua Zacarias Macedo 1423|VitorAlvesCarvalho@cuvox.de|(22) 5612-4758|4/11/1975
Maria|F|Goncalves|female|Vila Nossa Senhora de Fátima 1802|MariaFerreiraGoncalves@fleckens.hu|(86) 3939-2885|1/14/1970
Larissa|A|Martins|female|Rua Tenente Lira 406|LarissaAlvesMartins@rhyta.com|(67) 5208-9814|10/24/1993
João|S|Rodrigues|male|Rua dos Lírios 1597|JoaoSouzaRodrigues@teleworm.us|(81) 5825-8720|2/4/1964
Sophia|O|Melo|female|Rua Maria José Leal 1690|SophiaOliveiraMelo@rhyta.com|(32) 2786-5160|2/17/1995
Emily|M|Ferreira|female|Rua São Sebastião 1771|EmilyMeloFerreira@cuvox.de|(31) 5733-8515|6/7/1986
Vitór|A|Almeida|male|Rua Berenhauser Júnior 1651|VitorAlvesAlmeida@dayrep.com|(75) 7753-5390|9/28/1980
Tânia|C|Souza|female|Vila José 1236|TaniaCastroSouza@dayrep.com|(33) 7422-9357|1/22/1989
Mariana|P|Carvalho|female|Rua Pedro Tavares 1261|MarianaPintoCarvalho@superrito.com|(21) 9939-9613|10/3/1976
Marisa|C|Araujo|female|Rua Maria Scipioni 1191|MarisaCardosoAraujo@dayrep.com|(11) 6401-6100|8/24/1968
Bruno|C|Araujo|male|Rua Dona Maria Carolina 433|BrunoCavalcantiAraujo@fleckens.hu|(11) 6912-4072|5/24/1973
Marcos|L|Gomes|male|Rua José Vieira de Lima 228|MarcosLimaGomes@superrito.com|(11) 9982-2293|12/28/1964
Sophia|A|Dias|female|Via de Pedestre dos Cientistas 1430|SophiaAlvesDias@fleckens.hu|(11) 3628-6497|7/5/1960
Aline|A|Dias|female|Avenida Canastra 60|AlineAlvesDias@teleworm.us|(21) 4498-5019|8/1/1963
Amanda|A|Lima|female|Quadra CLS 407 Bloco B 772|AmandaAlvesLima@gustr.com|(61) 2557-6931|6/5/1983
Diego|C|Santos|male|Rua Anubis 1230|DiegoCorreiaSantos@fleckens.hu|(69) 3599-7725|9/2/1987
João|M|Castro|male|Travessa Siqueira Campos 1023|JoaoMartinsCastro@armyspy.com|(43) 4007-8485|3/5/1965
Giovanna|C|Cardoso|female|Rua D 1743|GiovannaCavalcantiCardoso@superrito.com|(34) 5112-5803|11/9/1992
Beatrice|C|Cavalcanti|female|Rua Valdir Scarduelli 213|BeatriceCorreiaCavalcanti@einrot.com|(48) 4441-7088|12/10/1973
Carlos|C|Ribeiro|male|Rua Rio Negro 424|CarlosCarvalhoRibeiro@cuvox.de|(88) 8846-3821|4/24/1961
Matilde|C|Castro|female|Rua Forte Guanabara 1904|MatildeCarvalhoCastro@einrot.com|(11) 9963-9318|1/31/1983
Ana|R|Martins|female|Rua Conceição de Oliveira Carvalho Teixeira 818|AnaRibeiroMartins@superrito.com|(37) 9462-4336|9/9/1996
Luana|O|Cavalcanti|female|Jardim Amélia Jacob 1061|LuanaOliveiraCavalcanti@armyspy.com|(91) 8600-7299|12/2/1993
Eduardo|A|Cardoso|male|Rua Nilza Tereza Hoffman Pádua 1532|EduardoAlvesCardoso@armyspy.com|(27) 7772-4658|7/29/1979
Isabella|P|Araujo|female|Rua Gastão Pimenta Coelho 996|IsabellaPintoAraujo@dayrep.com|(28) 4777-2524|12/14/1966
Bianca|L|Fernandes|female|Rua Beliza de Castro 989|BiancaLimaFernandes@jourrapide.com|(93) 8752-3918|10/12/1979
Samuel|P|Barros|male|Rua Dezesseis 4|SamuelPereiraBarros@fleckens.hu|(22) 4574-2103|12/10/1970
Tomás|A|Cardoso|male|Rua Frei Feliciano 762|TomasAlvesCardoso@einrot.com|(21) 9742-4196|1/1/1997
Thaís|S|Martins|female|Rua Campo Grande 1882|ThaisSousaMartins@jourrapide.com|(67) 7761-9767|8/30/1986
Eduarda|B|Pinto|female|Quadra QN 503 Conjunto 10 5|EduardaBarbosaPinto@teleworm.us|(61) 5220-7358|9/21/1960
Livia|G|Rodrigues|female|Quadra Nove 270|LiviaGomesRodrigues@rhyta.com|(91) 4977-4787|2/15/1972
Tiago|M|Rodrigues|male|Rua Carlos Tenório das Neves 1045|TiagoMeloRodrigues@dayrep.com|(82) 4853-4195|8/4/1972
Diego|R|Melo|male|Rua Salvador Côco 836|DiegoRodriguesMelo@gustr.com|(19) 6496-9589|9/29/1975
Vitória|C|Lima|female|Rua Adelino Gomes Caetano 1008|VitoriaCavalcantiLima@teleworm.us|(19) 9117-5630|1/31/1978
Danilo|M|Carvalho|male|Rua Tapejara 214|DaniloMeloCarvalho@rhyta.com|(44) 5122-8914|2/1/1994
Renan|M|Dias|male|Viela Trinta e Três 1662|RenanMartinsDias@cuvox.de|(11) 6117-4412|5/29/1970
Anna|G|Santos|female|Rua Paschoal Mele 1357|AnnaGomesSantos@rhyta.com|(16) 3139-3666|3/24/1994
Livia|M|Melo|female|Rua Jacinto Peixoto 1094|LiviaMartinsMelo@jourrapide.com|(62) 7247-6609|8/4/1996
Sofia|M|Dias|female|Condomínio Parque dos Buritis 106|SofiaMartinsDias@einrot.com|(61) 8877-2757|11/11/1955
Beatrice|G|Rodrigues|female|Rua Antônio Romano 1118|BeatriceGomesRodrigues@dayrep.com|(35) 8495-3564|12/12/1971
Julia|S|Cavalcanti|female|Rua Santa Lúzia 665|JuliaSousaCavalcanti@fleckens.hu|(85) 6175-4251|12/10/1964
Breno|P|Cunha|male|Rua Ipuacu 1709|BrenoPereiraCunha@cuvox.de|(21) 6475-7700|2/9/1997
Clara|S|Melo|female|Rua Joaquim Faustino de Camargo 1004|ClaraSantosMelo@rhyta.com|(11) 4596-2734|11/14/1961
Ana|A|Alves|female|Quadra Quadra 03 Conjunto B 285|AnaAlmeidaAlves@rhyta.com|(61) 8992-5251|4/22/1980
Lavinia|A|Ribeiro|female|Rua Assunção 1429|LaviniaAlmeidaRibeiro@einrot.com|(87) 9266-9387|6/19/1994
Lucas|M|Costa|male|Rua Vigario Amâncio 85|LucasMartinsCosta@superrito.com|(32) 3321-4874|7/13/1988
Marisa|A|Goncalves|female|Rua Doutor Tavares de Macedo 1278|MarisaAlvesGoncalves@jourrapide.com|(21) 2080-8976|3/29/1956
João|M|Rodrigues|male|Rua Etelvina Tomaz de Souza 1531|JoaoMartinsRodrigues@jourrapide.com|(21) 8255-3194|2/21/1965
Davi|O|Ferreira|male|Rua Quaresmeira 1470|DaviOliveiraFerreira@einrot.com|(81) 9380-8036|4/8/1994
Manuela|A|Fernandes|female|Rua Catanduvas 1333|ManuelaAlvesFernandes@superrito.com|(81) 6091-4423|1/30/1969
Alex|C|Rocha|male|Avenida Desembargador Dermeval Lyrio 1705|AlexCastroRocha@fleckens.hu|(27) 9257-6229|10/12/1960
Caio|A|Cunha|male|Rua Guilherme Schell 1335|CaioAlmeidaCunha@fleckens.hu|(51) 7217-3926|11/30/1975
Isabelle|C|Sousa|female|Rua Salustiano Torres 1729|IsabelleCorreiaSousa@jourrapide.com|(81) 3394-7767|12/7/1960
Gabriela|C|Gomes|female|Avenida Presidente Castelo Branco 717|GabrielaCardosoGomes@cuvox.de|(71) 2685-8268|10/22/1964
Leila|R|Martins|female|Rua Rúbens de Santana Tavares 392|LeilaRibeiroMartins@armyspy.com|(41) 7634-8170|4/7/1957
Carolina|G|Sousa|female|Rua Nova Venécia 1730|CarolinaGoncalvesSousa@gustr.com|(27) 2030-6514|12/27/1975
Isabela|B|Cavalcanti|female|Rua Camilo Máximo 1358|IsabelaBarbosaCavalcanti@einrot.com|(11) 9791-7976|5/14/1987
Luiza|R|Azevedo|female|Morro do Macaco 151|LuizaRodriguesAzevedo@fleckens.hu|(21) 8043-9040|8/13/1972
Fernanda|R|Lima|female|Rua Marechal Deodoro 1890|FernandaRibeiroLima@armyspy.com|(19) 2196-3174|5/10/1988
Luiz|D|Azevedo|male|Rua Duque de Caxias 1774|LuizDiasAzevedo@superrito.com|(55) 6446-9146|7/21/1962
Yasmin|G|Lima|female|Rua Doutor Pedro Ernesto 397|YasminGomesLima@einrot.com|(84) 5347-8968|5/17/1972
Guilherme|F|Rocha|male|Rua Presidente Andrade Pinto 1901|GuilhermeFernandesRocha@rhyta.com|(47) 7668-6900|3/31/1981
Bruna|F|Costa|female|Quadra QNP 14 Conjunto E 360|BrunaFernandesCosta@armyspy.com|(61) 3370-8590|2/5/1991
Tiago|C|Sousa|male|Rua Bom Jardim 1508|TiagoCarvalhoSousa@fleckens.hu|(21) 2185-6656|4/19/1961
Bruna|O|Costa|female|Rua Gilberto Freire 147|BrunaOliveiraCosta@dayrep.com|(91) 3303-2304|4/23/1981
Eduarda|G|Silva|female|Rua Joaquim J. C. de Oliveira 1747|EduardaGoncalvesSilva@fleckens.hu|(19) 5455-2275|11/3/1993
Breno|L|Ferreira|male|Rua Júlia de Paula Pereira 877|BrenoLimaFerreira@superrito.com|(18) 6947-5734|4/26/1963
Gabriel|B|Alves|male|Rua Glauce Rocha 1703|GabrielBarbosaAlves@fleckens.hu|(31) 4396-7758|2/17/1962
João|A|Azevedo|male|Rua Afonso Ferreira Maia 1820|JoaoAlvesAzevedo@teleworm.us|(81) 8224-5285|9/14/1990
Kauã|L|Fernandes|male|Avenida Doutor Eloy Chaves 1362|KauaLimaFernandes@einrot.com|(67) 2698-3964|3/20/1984
Vitoria|C|Melo|female|Rua Lucilo Rossi 435|VitoriaCardosoMelo@rhyta.com|(16) 4157-8004|10/26/1972
Erick|S|Melo|male|Travessa Feliciano Peres 1616|ErickSouzaMelo@fleckens.hu|(21) 8596-5548|5/7/1969
Sophia|F|Silva|female|Rua Desembargador Cezar Salamonde 1350|SophiaFerreiraSilva@einrot.com|(24) 9214-7004|5/5/1995
Carlos|B|Souza|male|Alameda da Paz 196|CarlosBarrosSouza@cuvox.de|(91) 2326-3406|9/11/1979
Tomás|R|Correia|male|Rua B-003 499|TomasRochaCorreia@teleworm.us|(64) 9742-3110|7/10/1993
Ágatha|D|Cavalcanti|female|Travessa Manoel Novaes 429|AgathaDiasCavalcanti@teleworm.us|(73) 6120-3191|10/18/1985
Rodrigo|A|Rodrigues|male|Rua José Luiz Guimarães 910|RodrigoAlvesRodrigues@fleckens.hu|(83) 2834-8236|6/29/1996
Leonor|R|Lima|female|Rua Dois 1480|LeonorRochaLima@rhyta.com|(74) 3692-8178|10/24/1963
Luiz|D|Gomes|male|Quadra Quadra 052 404|LuizDiasGomes@gustr.com|(61) 4722-6277|5/8/1980
Bruna|R|Azevedo|female|Caminho 7-B 322|BrunaRodriguesAzevedo@dayrep.com|(71) 8173-3321|4/21/1988
Carla|O|Barbosa|female|Travessa Guarujá 1530|CarlaOliveiraBarbosa@superrito.com|(91) 7730-7282|10/13/1992
Rebeca|C|Fernandes|female|Rua Nilda de Queiroz Neves 303|RebecaCunhaFernandes@armyspy.com|(83) 9080-5960|8/25/1968
João|A|Santos|male|Rua Gervásio Ferreira 352|JoaoAraujoSantos@fleckens.hu|(21) 8544-6673|4/24/1961
Bianca|S|Correia|female|Rua Lucidio Arnoldo Beskow 535|BiancaSantosCorreia@dayrep.com|(55) 8049-6282|9/17/1967
Luis|C|Santos|male|Alameda dos Piquis 671|LuisCavalcantiSantos@armyspy.com|(11) 8513-3210|11/10/1981
Julia|B|Dias|female|Rua Nicanor de Paula Arruda 1468|JuliaBarrosDias@einrot.com|(15) 7395-6355|6/30/1975
Rodrigo|R|Oliveira|male|Rua Adílico Romeu Vitoretti 827|RodrigoRochaOliveira@armyspy.com|(15) 3782-6707|7/14/1956
Marisa|B|Oliveira|female|Rua Maria Joana Mulhmann 1988|MarisaBarrosOliveira@fleckens.hu|(41) 5879-6269|7/12/1967
Nicole|C|Ribeiro|female|Rua Leandro Dupré 943|NicoleCostaRibeiro@armyspy.com|(11) 4244-3792|9/13/1994
Marcos|C|Ribeiro|male|Rua Caldas Júnior 528|MarcosCastroRibeiro@superrito.com|(51) 9680-2505|10/29/1964
Julia|F|Castro|female|Rua Ângelo Salvati 380|JuliaFerreiraCastro@armyspy.com|(45) 5606-5557|7/24/1976
Daniel|B|Melo|male|Rua S 1318|DanielBarrosMelo@rhyta.com|(17) 7170-8584|2/12/1971
Leila|S|Martins|female|Rua Croácia 1372|LeilaSantosMartins@fleckens.hu|(11) 9826-7495|7/2/1979
Larissa|R|Santos|female|Rua Ernestina de Paula 74|LarissaRodriguesSantos@cuvox.de|(38) 9386-2463|9/23/1973
Gustavo|B|Martins|male|Rua Luiz Barbisan 650|GustavoBarrosMartins@teleworm.us|(19) 3275-2591|3/31/1957
Gabrielle|C|Almeida|female|Rua Bento Biancardi 995|GabrielleCardosoAlmeida@superrito.com|(14) 7238-3924|9/2/1985
Luis|S|Cardoso|male|Rua Miranda Pinto 1320|LuisSousaCardoso@fleckens.hu|(22) 6415-3297|9/19/1983
Gabrielle|C|Ribeiro|female|Rua da Penetração 377|GabrielleCostaRibeiro@gustr.com|(92) 6778-8964|1/27/1968
Tânia|S|Rodrigues|female|Rua Pedestre O 691|TaniaSouzaRodrigues@rhyta.com|(33) 2355-7188|4/25/1981
Luiza|S|Rodrigues|female|Quadra Quadra 449 281|LuizaSilvaRodrigues@einrot.com|(61) 8686-9240|10/16/1960
Danilo|S|Costa|male|Rua Sacramentina 1647|DaniloSousaCosta@armyspy.com|(91) 4880-2155|4/27/1960
Beatrice|R|Araujo|female|Rua Caçarema 58|BeatriceRibeiroAraujo@superrito.com|(81) 5663-8501|6/12/1994
Melissa|A|Castro|female|Rua Quinze de Novembro 67|MelissaAlvesCastro@rhyta.com|(34) 9741-4150|7/25/1971
Vinicius|C|Fernandes|male|Beco José Bicalho 38|ViniciusCastroFernandes@fleckens.hu|(33) 7946-9472|4/14/1972
Fernanda|C|Gomes|female|Rua João Pinto do Nascimento 1604|FernandaCorreiaGomes@superrito.com|(27) 2780-4331|6/3/1988
Matilde|C|Araujo|female|Rua R-Quarenta e Oito 1936|MatildeCardosoAraujo@jourrapide.com|(19) 4402-5678|11/17/1992
Carolina|A|Martins|female|Beco do Capela 1222|CarolinaAzevedoMartins@dayrep.com|(21) 5311-8504|9/30/1980
Larissa|S|Cardoso|female|Conjunto Cajazeiras X 409|LarissaSouzaCardoso@jourrapide.com|(71) 9470-3496|1/21/1976
Marina|R|Pinto|female|Travessa Holanda 195|MarinaRibeiroPinto@einrot.com|(91) 6368-8231|4/8/1970
Carolina|C|Rodrigues|female|Quadra 206 Sul Alameda 15 768|CarolinaCardosoRodrigues@armyspy.com|(63) 2795-5492|3/23/1977
Vinicius|G|Araujo|male|Avenida Said Tuma 217|ViniciusGomesAraujo@fleckens.hu|(17) 3635-7200|8/10/1990
Joao|A|Lima|male|Rua Graciliano Ramos 1372|JoaoAlmeidaLima@superrito.com|(19) 5315-5854|2/9/1992
Luan|B|Cavalcanti|male|Rua Guanabara 334|LuanBarbosaCavalcanti@cuvox.de|(31) 7470-7864|12/7/1978
Igor|G|Sousa|male|Quadra QNA 16 974|IgorGoncalvesSousa@fleckens.hu|(61) 7857-6405|8/10/1976
Vitor|B|Martins|male|Avenida Liverpool 1134|VitorBarrosMartins@rhyta.com|(62) 3548-9453|1/18/1956
Marina|A|Martins|female|Rua Lagoa Araruama 934|MarinaAraujoMartins@armyspy.com|(38) 9448-9317|6/17/1990
Guilherme|F|Barbosa|male|Rua Araçoiaba 261|GuilhermeFerreiraBarbosa@dayrep.com|(81) 7440-3101|2/10/1962
Antônio|A|Azevedo|male|Rua Jamouche Abdony 1660|AntonioAlmeidaAzevedo@cuvox.de|(67) 4638-9183|10/6/1963
Tomás|C|Souza|male|Avenida Um 1660|TomasCavalcantiSouza@dayrep.com|(98) 6553-3218|11/13/1968
Kai|A|Alves|male|Rua Três 932|KaiAzevedoAlves@jourrapide.com|(19) 4719-7711|10/2/1987
Júlio|F|Costa|male|Avenida Sete de Setembro 1064|JulioFernandesCosta@gustr.com|(16) 9825-6521|2/25/1984
Rodrigo|A|Correia|male|Rua Delegado Leopoldo Belczak 515|RodrigoAlmeidaCorreia@einrot.com|(41) 6017-9782|11/2/1982
Tomás|C|Souza|male|Rua Costa Rica 763|TomasCastroSouza@gustr.com|(51) 7434-8577|8/8/1958
Isabela|A|Fernandes|female|Rua Zacarias de Góes e Vasconcelos 293|IsabelaAzevedoFernandes@teleworm.us|(42) 5011-2631|5/25/1963
Sofia|C|Lima|female|Rua Professor Fernando Correia Silva 1144|SofiaCostaLima@cuvox.de|(19) 7270-5907|4/24/1970
Antônio|M|Ribeiro|male|Rua Cinquenta e Três 1106|AntonioMeloRibeiro@gustr.com|(87) 7078-8204|9/3/1974
Ágatha|S|Barros|female|Avenida E 937|AgathaSantosBarros@teleworm.us|(62) 9786-5570|11/26/1971
João|C|Melo|male|Avenida Marechal Castelo Branco 330|JoaoCostaMelo@dayrep.com|(86) 7929-9391|3/29/1962
Vitor|B|Goncalves|male|Quadra QBR 04 Bloco H 148|VitorBarbosaGoncalves@superrito.com|(61) 2547-4624|1/31/1989
Yasmin|C|Oliveira|female|Rua José Vicente do Nascimento 1664|YasminCavalcantiOliveira@gustr.com|(83) 4432-3951|11/29/1968
Raissa|A|Castro|female|Rua Newton Fonseca 745|RaissaAlvesCastro@rhyta.com|(32) 4953-9697|8/29/1972
Antônio|F|Carvalho|male|Rua Arthur Bernardes 896|AntonioFerreiraCarvalho@fleckens.hu|(11) 8957-6174|4/14/1978
Diego|L|Cavalcanti|male|Avenida Desembargador Edson Queiroz do Valle 454|DiegoLimaCavalcanti@dayrep.com|(27) 3837-8317|12/19/1955
Giovanna|F|Rodrigues|female|Rua Isanor Furquim de Campos 914|GiovannaFernandesRodrigues@fleckens.hu|(11) 2517-4807|10/1/1956
Thiago|P|Araujo|male|Vila Soares 990|ThiagoPereiraAraujo@armyspy.com|(91) 6470-7045|8/24/1970
Anna|C|Rodrigues|female|Rua Zenóbio Acioli 125|AnnaCorreiaRodrigues@fleckens.hu|(11) 4343-5087|10/23/1991
Gustavo|C|Cavalcanti|male|Praça Marcelino da Gama 431|GustavoCardosoCavalcanti@gustr.com|(21) 2495-5537|7/29/1961
Antônio|R|Lima|male|Rua G 442|AntonioRodriguesLima@dayrep.com|(12) 5328-5008|9/12/1978
Vitoria|P|Carvalho|female|Rua 62 1022|VitoriaPintoCarvalho@dayrep.com|(63) 6565-5991|9/7/1975
Matheus|C|Araujo|male|Rua Limeira 1679|MatheusCostaAraujo@einrot.com|(13) 2690-2065|8/10/1988
Gabrielly|A|Barros|female|Avenida José Moacir Banhos de Araújo 1343|GabriellyAraujoBarros@jourrapide.com|(96) 7727-2863|10/1/1965
Sophia|C|Lima|female|Rua Marquês de Pombal 1333|SophiaCavalcantiLima@einrot.com|(41) 8417-2027|11/6/1969
Bruno|A|Rocha|male|Passagem Cristo Rei 1409|BrunoAraujoRocha@fleckens.hu|(91) 5822-6397|10/24/1995
Luana|F|Alves|female|Rua Alberto Messias da Silva 1234|LuanaFerreiraAlves@fleckens.hu|(81) 8558-6643|1/20/1961
Clara|F|Santos|female|Rua Yolanda Piccolomini Massucci 1860|ClaraFerreiraSantos@rhyta.com|(16) 7991-2773|12/13/1989
Nicolash|C|Fernandes|male|Travessa Serra do Araguaia 854|NicolashCarvalhoFernandes@cuvox.de|(84) 2909-7571|9/16/1976
Bruna|S|Azevedo|female|Rua Júlio Durand 1261|BrunaSantosAzevedo@fleckens.hu|(55) 7249-5205|12/29/1972
Emily|C|Goncalves|female|Rua General Sampaio 473|EmilyCastroGoncalves@teleworm.us|(81) 5131-4345|12/20/1982
Otávio|G|Pinto|male|Rua Gino Parolin 691|OtavioGomesPinto@teleworm.us|(41) 5158-8419|4/25/1992
Sophia|C|Fernandes|female|Rua Zumbi 771|SophiaCarvalhoFernandes@teleworm.us|(86) 8094-8617|2/5/1967
Laura|C|Goncalves|female|Rua Clara Aurora 1518|LauraCavalcantiGoncalves@armyspy.com|(11) 7712-6249|10/9/1990
Larissa|P|Melo|female|Rua Inhame 952|LarissaPintoMelo@einrot.com|(34) 6951-7462|6/27/1985
Aline|A|Ferreira|female|Rua Doutor José C. D'Arce 54|AlineAlvesFerreira@jourrapide.com|(67) 3984-5605|7/3/1957
Douglas|P|Rocha|male|Rua Acúrcio Alves Ramos 997|DouglasPereiraRocha@rhyta.com|(16) 3101-6796|9/7/1977
Leila|L|Azevedo|female|Rua Bolonha 509|LeilaLimaAzevedo@superrito.com|(11) 9329-2113|10/14/1994
Julieta|R|Santos|female|Travessa Francelino Santos 444|JulietaRodriguesSantos@cuvox.de|(79) 9019-5292|4/30/1969
Samuel|F|Martins|male|Praça Aquiles 1629|SamuelFernandesMartins@rhyta.com|(21) 6031-2454|12/31/1975
Giovana|L|Souza|female|Travessa Tocantins 1019|GiovanaLimaSouza@armyspy.com|(81) 4135-9064|12/24/1996
Isabelle|A|Alves|female|Rua Jambeiro 944|IsabelleAlmeidaAlves@fleckens.hu|(12) 4695-7994|7/21/1956
Luan|B|Rocha|male|Rua Rio Grande do Sul 1590|LuanBarbosaRocha@teleworm.us|(55) 4895-7959|6/9/1968
Victor|R|Ribeiro|male|Rua Itaipú 526|VictorRochaRibeiro@jourrapide.com|(47) 2710-6157|11/6/1959
Julia|P|Gomes|female|Travessa Alfredo Gama 980|JuliaPintoGomes@teleworm.us|(81) 5297-4474|3/14/1986
Carolina|P|Oliveira|female|Rua Valdir Sales Sabóia 871|CarolinaPereiraOliveira@fleckens.hu|(21) 6963-4295|1/8/1965
Ana|A|Sousa|female|Rua Setenta e Dois 576|AnaAlvesSousa@einrot.com|(19) 9316-2618|1/6/1969
Yasmin|B|Carvalho|female|Rua Érico Veríssimo 1126|YasminBarbosaCarvalho@rhyta.com|(61) 4024-9671|7/17/1980
Leonardo|B|Santos|male|Rua Padre Manoel da Costa 993|LeonardoBarbosaSantos@armyspy.com|(62) 7749-9496|5/7/1971
Nicole|C|Fernandes|female|Rua Aluízio Pereira Esteves 590|NicoleCardosoFernandes@jourrapide.com|(33) 4048-6587|4/18/1984
Bruna|F|Barbosa|female|Rua H 1986|BrunaFerreiraBarbosa@dayrep.com|(61) 5553-8781|9/12/1981
Larissa|P|Sousa|female|Rua Djalma Assis 146|LarissaPereiraSousa@jourrapide.com|(32) 3380-7862|12/20/1989
Emily|C|Fernandes|female|Rua Henrique Dantas 1497|EmilyCostaFernandes@dayrep.com|(11) 2280-6800|10/12/1990
Vitoria|B|Azevedo|female|Rua 6 1827|VitoriaBarrosAzevedo@teleworm.us|(62) 8513-4513|7/19/1978
Luis|C|Goncalves|male|Rua do Aprendiz 969|LuisCunhaGoncalves@fleckens.hu|(21) 4383-7405|5/21/1975
Nicolash|M|Araujo|male|Rua Joana Kosiba 1557|NicolashMeloAraujo@jourrapide.com|(41) 7482-8563|10/27/1965
Marina|S|Souza|female|Rua Vitória 1878|MarinaSantosSouza@fleckens.hu|(12) 9734-8713|9/22/1989
Bianca|A|Santos|female|Rua Sete 440|BiancaAzevedoSantos@rhyta.com|(65) 7566-6362|8/14/1962
Melissa|A|Martins|female|Rua Marquês de Paranaguá 1013|MelissaAlvesMartins@cuvox.de|(75) 9733-9979|10/29/1980
Gabriel|C|Alves|male|Rua do Ingá 13|GabrielCostaAlves@cuvox.de|(84) 9650-8552|10/24/1977
Vitor|O|Martins|male|Rua H-5 1821|VitorOliveiraMartins@armyspy.com|(92) 3723-8737|3/29/1997
Rodrigo|A|Rocha|male|Rua Cajazeira 564|RodrigoAlvesRocha@superrito.com|(75) 7487-4669|6/29/1963
Vinícius|A|Melo|male|Rua Valença 1844|ViniciusAraujoMelo@teleworm.us|(47) 3888-3133|4/19/1956
Raissa|R|Rodrigues|female|Travessa Bruno Valente 646|RaissaRochaRodrigues@jourrapide.com|(85) 2396-7358|6/13/1994
Vitória|O|Martins|female|Rua Princesa Diana 1450|VitoriaOliveiraMartins@cuvox.de|(15) 3879-6742|1/9/1990
Livia|C|Melo|female|Rua Francisco Tolentino 479|LiviaCarvalhoMelo@teleworm.us|(48) 5791-4255|11/19/1978
João|C|Rodrigues|male|Rua Doutor Octávio de Oliveira Santos 305|JoaoCunhaRodrigues@teleworm.us|(11) 8151-5566|7/3/1963
Igor|R|Gomes|male|Rua das Malvas 551|IgorRibeiroGomes@armyspy.com|(11) 8924-8918|6/2/1967
Daniel|R|Silva|male|Rua Grécia 101|DanielRodriguesSilva@cuvox.de|(21) 6845-2565|5/22/1989
Beatrice|C|Correia|female|Rua Dourado 225|BeatriceCardosoCorreia@cuvox.de|(81) 5244-7588|8/13/1966
Julia|R|Ribeiro|female|Vila Marques de souza 1419|JuliaRochaRibeiro@teleworm.us|(71) 6988-7820|7/24/1977
Tomás|R|Melo|male|Rua Paulínia 1974|TomasRibeiroMelo@dayrep.com|(17) 2769-9547|6/30/1967
Letícia|C|Rodrigues|female|Avenida Doutor Augusto Simoes Lopes 500|LeticiaCavalcantiRodrigues@fleckens.hu|(53) 2137-5605|3/8/1982
Gustavo|P|Melo|male|Rua Jacunda 1714|GustavoPintoMelo@einrot.com|(94) 5321-2379|4/5/1972
Beatrice|O|Barbosa|female|Rua A 809|BeatriceOliveiraBarbosa@superrito.com|(22) 5644-2939|9/6/1961
Lucas|M|Silva|male|Rua João Dall Alba 1615|LucasMeloSilva@einrot.com|(54) 2525-7039|9/20/1957
Júlio|S|Cunha|male|Rua Dirnei Gomes 122|JulioSouzaCunha@armyspy.com|(48) 8857-7379|2/22/1959
Pedro|C|Rocha|male|Rua das Glicínias 1016|PedroCunhaRocha@jourrapide.com|(11) 3468-2288|6/4/1990
Julieta|C|Cunha|female|Rua Onze 622|JulietaCorreiaCunha@teleworm.us|(27) 5054-5205|4/19/1971
Beatriz|C|Souza|female|Rua Tobias Barreto 934|BeatrizCorreiaSouza@superrito.com|(54) 2144-6556|9/3/1961
Guilherme|F|Cunha|male|Rua Santa Luzia 1084|GuilhermeFernandesCunha@superrito.com|(48) 2159-8382|2/8/1971
Manuela|A|Rodrigues|female|Rua Doralino Pacheco 1474|ManuelaAzevedoRodrigues@einrot.com|(55) 2073-8863|5/25/1981
Vinícius|C|Correia|male|Rua Ernesto Bruns 233|ViniciusCarvalhoCorreia@superrito.com|(47) 3012-9230|1/6/1983
Luiz|F|Barbosa|male|Rua Elato 515|LuizFernandesBarbosa@cuvox.de|(11) 7893-9519|6/23/1985
Carlos|C|Rodrigues|male|Rua Nane Marcon 357|CarlosCorreiaRodrigues@superrito.com|(19) 8683-9660|1/18/1959
José|C|Carvalho|male|Rua Montequeiro 1661|JoseCavalcantiCarvalho@rhyta.com|(92) 9304-9292|8/6/1981
Vinícius|C|Ribeiro|male|Rua Itaboraí 1277|ViniciusCarvalhoRibeiro@rhyta.com|(46) 2898-9832|5/9/1963
Matilde|C|Ribeiro|female|Rua Osvaldo Ribeiro 1151|MatildeCunhaRibeiro@teleworm.us|(21) 8073-7385|2/12/1974
Samuel|C|Silva|male|Rua Bom Pastor 540|SamuelCunhaSilva@rhyta.com|(99) 8340-9110|9/4/1988
Vitór|C|Goncalves|male|Rua Antônio Marenda 21|VitorCardosoGoncalves@armyspy.com|(42) 3373-2418|8/11/1962
Amanda|A|Fernandes|female|Rua Gentil de Almeida 737|AmandaAlvesFernandes@einrot.com|(21) 9613-4752|11/26/1993
Manuela|B|Gomes|female|Rua Presidente Olegário 510|ManuelaBarbosaGomes@armyspy.com|(11) 5262-3275|8/7/1963
Letícia|F|Melo|female|Rua DW-77 1779|LeticiaFernandesMelo@cuvox.de|(31) 4037-3834|12/22/1979
Thiago|A|Carvalho|male|Rua Maria de Fátima 571|ThiagoAraujoCarvalho@einrot.com|(11) 7554-8425|12/20/1967
Vinicius|S|Cardoso|male|Rua Antônio Encarnação Júnior 145|ViniciusSantosCardoso@dayrep.com|(19) 4303-3937|7/31/1959
Rafaela|A|Goncalves|female|Rua Cecília Mady Elias 1139|RafaelaAraujoGoncalves@cuvox.de|(11) 6859-4745|1/13/1974
Bianca|G|Pereira|female|Rua Silva Alvarenga 642|BiancaGoncalvesPereira@jourrapide.com|(81) 3393-2517|6/25/1961
Vitór|R|Cunha|male|Rua Brasílio Franca 1072|VitorRodriguesCunha@gustr.com|(41) 4094-4299|5/14/1972
Carlos|O|Araujo|male|Rua Funcionário João Rosa 1905|CarlosOliveiraAraujo@gustr.com|(34) 5799-5570|1/26/1984
Miguel|M|Sousa|male|Avenida Elvira Dorsa Biasiolo 780|MiguelMeloSousa@einrot.com|(16) 7199-5039|4/24/1958
Antônio|S|Carvalho|male|Rua José Flaviano Costa 1400|AntonioSousaCarvalho@armyspy.com|(11) 7270-2043|5/12/1957
Vitór|L|Barbosa|male|Rua Falcão 349|VitorLimaBarbosa@rhyta.com|(81) 2280-7480|7/21/1962
Livia|M|Rocha|female|Rua Senador Saraiva 1121|LiviaMartinsRocha@einrot.com|(41) 2828-3281|4/11/1992
Melissa|S|Silva|female|Rua Maria do Carmo C. Nunes 488|MelissaSousaSilva@jourrapide.com|(51) 6201-3808|4/14/1984
Davi|C|Silva|male|Rua Bengue 1329|DaviCostaSilva@armyspy.com|(27) 6446-4643|3/12/1968
Danilo|C|Barbosa|male|Rua Oito de Maio 1158|DaniloCunhaBarbosa@gustr.com|(91) 8630-3040|12/21/1966
Vitor|C|Araujo|male|Rua da Franca 1258|VitorCostaAraujo@dayrep.com|(31) 3046-5874|4/13/1996
Lavinia|L|Dias|female|Rua Gustavo Barroso 1180|LaviniaLimaDias@armyspy.com|(48) 3547-4762|7/19/1973
Kauã|C|Sousa|male|Avenida Senador Teotônio Vilela 1217|KauaCunhaSousa@superrito.com|(16) 2948-3108|4/2/1959";
        
        
        
        $profisisonalArray = explode("\n", $string);

        foreach ($profisisonalArray as $profissionalLine) {
            
            $profissionalLine = explode("|", $profissionalLine);
            $profissional = new Profissional();
            
            $profissional->setCpf($this->gerarCpf())
                    ->setNascimento(\DateTime::createFromFormat("m/d/Y", trim($profissionalLine[7])))
                    ->setEndereco($profissionalLine[4])
                    ->setNome($profissionalLine[0]. " ". $profissionalLine[1]. ". ". $profissionalLine[2])
                    ->setRg("15641654")
                    ->setFoto("")
                    ->setSexo(strtoupper(substr($profissionalLine[3], 0, 1)))
                    ->setTelefone($profissionalLine[6])
                    ->setDataCadastro(new \DateTime("now"));
            
            $manager->persist($profissional);
        }
        
        $manager->flush();
        
                
    }

    private function gerarCpf()
    {
        $num = array();
        $num[9]=$num[10]=$num[11]=0;
        for ($w=0; $w > -2; $w--){
            for($i=$w; $i < 9; $i++){
                $x=($i-10)*-1;
                $w==0?$num[$i]=rand(0,9):'';
                ($w==-1 && $i==$w && $num[11]==0)?
                    $num[11]+=$num[10]*2    :
                    $num[10-$w]+=$num[$i-$w]*$x;
            }
            $num[10-$w]=(($num[10-$w]%11)<2?0:(11-($num[10-$w]%11)));
        }
        return $num[0].$num[1].$num[2].$num[3].$num[4].$num[5].$num[6].$num[7].$num[8].$num[10].$num[11];
    }



    
    
    
    
    
}
