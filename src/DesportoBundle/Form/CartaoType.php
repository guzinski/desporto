<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Cartao;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Test\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of CartaoType
 *
 * @author Luciano
 */
class CartaoType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("inscricao", ChoiceType::class);
        $builder->add("minuto");
        $builder->add("tempo", ChoiceType::class, [
            'choices' => [
                    'Selecione' => null,
                    '1º' => 1,
                    '2º' => 2,
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cartao::class,
        ));
    }
}
