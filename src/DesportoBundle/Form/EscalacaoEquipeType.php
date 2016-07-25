<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * Description of EscalacaoEquipeType
 *
 */
class EscalacaoEquipeType extends AbstractType
{
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options)
    {
        $builder->add("campeonato", EntityType::class, array(
            'class' => Campeonato::class,
            'placeholder' => "Selecione"
        ));
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver)
    {
        parent::configureOptions($resolver);
    }

    
    
}
