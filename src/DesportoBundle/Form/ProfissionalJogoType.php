<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\ProfissionalJogo;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ProfissionalJogoType
 *
 * @author Luciano
 */
class ProfissionalJogoType extends AbstractType 
{
   
    
    public function buildForm(FormBuilderInterface $builder, array $options) 
    {
        
        $builder->add("inscricao", \Symfony\Component\Form\Extension\Core\Type\HiddenType::class, ['property_path' => 'inscricao.id' ]);
        $builder->add("numero");
        $builder->add('capitao', CheckboxType::class, array(
            'label'    => null,
            'required' => false,
        ));
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => ProfissionalJogo::class,
        ));
    }

    
    
}
