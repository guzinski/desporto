<?php

namespace DesportoBundle\Form;

use DesportoBundle\Doctrine\Type\EnumSexoType;
use DesportoBundle\Entity\Profissional;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of PorfissionalType
 *
 * @author Luciano
 */
class ProfissionalType extends AbstractType
{
    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }

    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add("nome", TextType::class)
                ->add("foto", HiddenType::class)
                ->add("nascimento", DateType::class, array(
                            'label'  => 'Data de Nascimento',
                            'widget' => 'single_text',
                            'format' => 'dd/MM/yyyy',
                  ))
                ->add("sexo", ChoiceType::class, array(
                    'choices' => array('Feminino' => EnumSexoType::FEMININO, 'Masculino' => EnumSexoType::MASCULINO),
                    'placeholder' => "Selecione"
                ))
                ->add("cpf", TextType::class, ['label'=>"CPF"])
                ->add("rg", TextType::class, ['label'=>"RG", 'required'=>FALSE])
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
            'data_class' => Profissional::class,
        ));
    }

    
}
