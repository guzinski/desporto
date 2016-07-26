<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\EdicaoCampeonatoEquipeProfissional;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of EscalacaoEquipeType
 *
 */
class EscalacaoEquipeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("profissional", EntityType::class, array(
            'class' => Campeonato::class,
            'placeholder' => "Selecione"
        ));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EdicaoCampeonatoEquipeProfissional::class,
        ));
    }

    
    
}
