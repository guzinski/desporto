<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Service;

/**
 * Description of StringFilters
 *
 * @author Luciano
 */
class StringFilters
{
    
    
    public function cpf($cpf)
    {
        $cpf = preg_replace("/[^0-9]/", "", $cpf);

        $mascara = '###.###.###/##'; 

        $indice = 0;
        for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $cpf[$indice++];
        }

        return $mascara;
    }
    
    
    public function cnpj($cnpj) 
    {
        $cnpj = preg_replace("/[^0-9]/", "", $cnpj);

        $mascara = '##.###.###/####-##'; 

        $indice = 0;
        for ($i=0; $i < strlen($mascara); $i++) {
                if ($mascara[$i]=='#') $mascara[$i] = $cnpj[$indice++];
        }

        return $mascara;
    }

    
    public function telefone($telefone)
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
    
    
}
