<?php

namespace DesportoBundle\Twig;

class AppExtension extends \Twig_Extension
{
    
    /**
     *
     * @var \DesportoBundle\Service\StringFilters 
     */
    private $filters;


    public function __construct()
    {
        $this->filters = new \DesportoBundle\Service\StringFilters();
    }
    
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
        return $this->filters->cpf($cpf);
    }
    
    public function cnpjFilter($cnpj) 
    {
        return $this->filters->cnpj($cnpj);
    }
    
    public function telefoneFilter($telefone) 
    {
        return $this->filters->telefone($telefone);
    }


    public function getName()
    {
        return 'app_extension';
    }
}
