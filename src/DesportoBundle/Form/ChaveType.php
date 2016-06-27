<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Chave;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of ChaveType
 *
 * @author Luciano
 */
class ChaveType extends AbstractType
{    
    
    private $manager;

    public function __construct(EntityManager $manager)
    {
        $this->manager = $manager;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add($builder->create("numero", HiddenType::class));
        $builder->add($builder->create("equipes", CollectionType::class, array(
                'label'         => false,
                'data_class'    => null
        ))->addModelTransformer(new EquipeTransformer($this->manager)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Chave::class,
        ));
    }

    
}
