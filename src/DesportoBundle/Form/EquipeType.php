<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Equipe;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of EquipeType
 *
 * @author Luciano
 */
class EquipeType extends AbstractType
{
    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nome", TextType::class)
                ->add("apelido", TextType::class)
                ->add("brasao", HiddenType::class)
                ->add("responsavel", TextType::class, ['label'=>"Responsável"])
                ->add("endereco", TextType::class)
                ->add("telefone", TextType::class)
                ->add($builder->create("arquivos", CollectionType::class, array(
                        'entry_type'    => HiddenType::class,
                        'allow_add'     => true,
                        'allow_delete'  => true,
                        'label'         => false,
                        'data_class'    => null
                ))->addModelTransformer(new ArquivoTransformer($this->manager)));
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Equipe::class,
        ));
    }
    
    
}
