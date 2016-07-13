<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\FaseClassificatoria;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of FaseClassificatoriaType
 *
 * @author Luciano
 */
class FaseClassificatoriaType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add($builder->create("equipes", CollectionType::class, array(
                'label'         => false,
                'data_class'    => null,
                'allow_add'     => true,
        ))->addModelTransformer(new EquipeTransformer($this->manager)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => FaseClassificatoria::class,
        ));
    }

    
    
    
}
