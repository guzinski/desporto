<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Cartao;
use DesportoBundle\Entity\InscricaoProfissional;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
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
        $builder->add('inscricao', EntityType::class, [
            'placeholder' => 'Selecione',
            'choices' => $options['inscricoes'],
            'class' => InscricaoProfissional::class
        ]);
        $builder->add("minuto", NumberType::class);
        $builder->add("cor", HiddenType::class);
        $builder->add("tempo", ChoiceType::class, [
            'placeholder' => 'Selecione',
            'choices' => [
                '1º' => '1',
                '2º' => '2',
            ]
        ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Cartao::class,
        ));
        $resolver->setRequired(array(
            'inscricoes',
        ));
    }
}
