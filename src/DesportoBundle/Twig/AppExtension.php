<?php

namespace DesportoBundle\Twig;

class AppExtension extends \Twig_Extension
{
    public function getFilters()
    {
        return array(
            new \Twig_SimpleFilter('cpf', array($this, 'cpfFilter')),
            new \Twig_SimpleFilter('telefone', array($this, 'telefoneFilter')),
            new \Twig_SimpleFilter('cnpj', array($this, 'cnpjFilter')),
        );
    }

    public function cpfFilter($cpf) 
    {
        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        $mascara = '###.###.###/##'; 

        $indice = 0;
        for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $cpf[$indice++];
        }

        return $mascara;
    }
    
    public function cnpjFilter($cnpj) 
    {
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

        $mascara = '##.###.###/####-##'; 

        $indice = 0;
        for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $cnpj[$indice++];
        }

        return $mascara;
    }
    
    public function telefoneFilter($telefone) 
    {
        $telefone = preg_replace("/[^0-9]/", "", $telefone);

        if (strlen($telefone) == 10) {
            $mascara = '(##) ####-####'; 
        } elseif (strlen($telefone) == 11) {
            $mascara = '(##) #####-####'; 
        }

        $indice = 0;
        for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $telefone[$indice++];
        }

        return $mascara;
    }


    public function getName()
    {
        return 'app_extension';
    }
}
