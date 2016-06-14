<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\EdicaoCampeonato;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

/**
 * Description of EdicaoCampeonato
 *
 * @author Luciano
 */
class EdicaoCampeonatoType extends AbstractType
{
    
    
    private $manager;

    public function __construct(ObjectManager $manager)
    {
        $this->manager = $manager;
    }
    
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        
        $builder->add("campeonato", EntityType::class, array(
            'class' => Campeonato::class,
            'placeholder' => "Selecione"
            
        ));
        $builder->add("modalidade", ChoiceType::class, array(
            'choices' => array('Feminino' => EdicaoCampeonato::FEMININO, 'Masculino' => EdicaoCampeonato::MASCULINO),
            'placeholder' => "Selecione"
            
        ));
        $builder->add("quantidadeEquipes");
        $builder->add("quantidadeJogadores");
        $builder->add("tipo", ChoiceType::class, array(
            'choices' => array('Torneio' => EdicaoCampeonato::TORNEIO, 'Chave' => EdicaoCampeonato::CHAVE),
            'placeholder' => "Selecione"
            
        ));
        $desempate = array(
                'Disciplina' => EdicaoCampeonato::DISCIPLINA, 
                'Número de Vitórias' => EdicaoCampeonato::VITORIA, 
                'Saldo de Gols' => EdicaoCampeonato::SALDO_GOLS, 
        );
        $builder->add("desempate1", ChoiceType::class, array(
            'choices' => $desempate,
            'placeholder' => "Selecione"
        ));
        $builder->add("desempate2", ChoiceType::class, array(
            'choices' => $desempate,
            'placeholder' => "Selecione"
        ));
        $builder->add("desempate3", ChoiceType::class, array(
            'choices' => $desempate,
            'placeholder' => "Selecione"
        ));
        $builder->add("quantidadeChaves");
        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EdicaoCampeonato::class,
        ));
    }

    
    
    
}
