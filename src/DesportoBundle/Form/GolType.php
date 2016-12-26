<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Gol;
use DesportoBundle\Entity\InscricaoProfissional;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of GolType
 *
 * @author Luciano
 */
class GolType extends AbstractType
{
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("inscricao", EntityType::class, array(
            'class' => InscricaoProfissional::class,
            'choice_label' => 'profissional',

        ));
        $builder->add("jogo", HiddenType::class);
        $builder->add("minuto");
        $builder->add("tempo");
        $builder->add("contra");
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Gol::class,
        ));
    }

    
}
