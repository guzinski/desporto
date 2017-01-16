<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Gol;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of GolType
 *
 * @author Luciano
 */
class GolType extends AbstractType
{

    
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('inscricao', \Symfony\Bridge\Doctrine\Form\Type\EntityType::class, [
            'placeholder' => 'Selecione',
            'choices' => $options['inscricoes'],
            'class' => \DesportoBundle\Entity\InscricaoProfissional::class
        ]);
        $builder->add("minuto", NumberType::class);
        $builder->add("tempo", ChoiceType::class, [
            'placeholder' => 'Selecione',
            'choices' => [
                '1º' => '1',
                '2º' => '2',
            ]
        ]);
//        $builder->get('inscricao')
//            ->addModelTransformer(new InscricaoProfissionalTransformer($this->manager));
        
    }
    
    

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Gol::class,
        ));
        $resolver->setRequired(array(
            'inscricoes',
        ));
    }

}
