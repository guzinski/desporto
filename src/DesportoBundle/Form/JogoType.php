<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use Symfony\Component\Form\AbstractType;

/**
 * Description of JogoType
 *
 * @author Luciano
 */
class JogoType extends AbstractType {
    
    
    public function buildForm(\Symfony\Component\Form\FormBuilderInterface $builder, array $options) {
        parent::buildForm($builder, $options);
    }

    public function configureOptions(\Symfony\Component\OptionsResolver\OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => \DesportoBundle\Entity\Jogo::class,
        ));
    }

    
}
