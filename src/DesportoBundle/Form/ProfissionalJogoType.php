<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\InscricaoProfissional;
use DesportoBundle\Entity\ProfissionalJogo;
use Shapecode\Bundle\HiddenEntityTypeBundle\Form\Type\HiddenEntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        $builder->add("inscricao", HiddenEntityType::class, [
            'class' => InscricaoProfissional::class,
        ]);
        $builder->add("numero", NumberType::class);
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
