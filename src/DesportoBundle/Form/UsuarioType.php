<?php
namespace DesportoBundle\Form;

use DesportoBundle\Entity\Nivel;
use DesportoBundle\Entity\Usuario;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Description of UsuarioType
 *
 * @author Luciano
 */
class UsuarioType extends AbstractType
{
    public function getName()
    {
        return "usuario";
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nome')
            ->add('email', EmailType::class)
            ->add('senha', RepeatedType::class, array(
                    'type' => PasswordType::class,
                    'invalid_message' => "Insira a senha.",
                    'first_options'  => array('label' => 'Senha'),
                    'second_options' => array('label' => 'Confirmar senha'),
                ))
            ->add('nivel', EntityType::class, array(
                'class'         => Nivel::class,
                'placeholder'   => 'Selecione',
                'empty_data'    => null,
                'label'         => 'Nível'
        ));

    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => Usuario::class,
        ));
    }

}
