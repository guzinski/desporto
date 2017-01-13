<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Jogo;
use DesportoBundle\Entity\ProfissionalJogo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of JogoType
 *
 * @author Luciano
 */
class JogoType extends AbstractType 
{
    
    public function buildForm(FormBuilderInterface $builder, array $options) {
        
        $builder->add("profissionalJogos", CollectionType::class, array(
            'entry_type'   => ProfissionalJogoType::class,
            'by_reference'  => FALSE,
        ));
        $builder->add("gols", CollectionType::class, array(
            'entry_type'    => GolType::class,
            'allow_add'     => TRUE,
            'by_reference'  => FALSE,
        ));
        $builder->add("cartoes", CollectionType::class, array(
            'entry_type'    => CartaoType::class,
            'allow_add'     => TRUE,
            'by_reference'  => FALSE,
        ));
        $builder->add("mesario");
        $builder->add("arbitro1");
        $builder->add("arbitro2");

    }

    public function configureOptions(OptionsResolver $resolver) {
        $resolver->setDefaults(array(
            'data_class' => Jogo::class,
        ));
    }

    
}
