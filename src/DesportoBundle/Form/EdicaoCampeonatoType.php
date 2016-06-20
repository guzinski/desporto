<?php

namespace DesportoBundle\Form;

use DesportoBundle\Doctrine\Type\EnumSexoType;
use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\EdicaoCampeonato;
use DesportoBundle\Entity\Equipe;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
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
        //Passo 1
        $builder->add("campeonato", EntityType::class, array(
            'class' => Campeonato::class,
            'placeholder' => "Selecione"
            
        ));
        $builder->add("modalidade", ChoiceType::class, array(
            'choices' => array('Feminino' => EnumSexoType::FEMININO, 'Masculino' => EnumSexoType::MASCULINO),
            'placeholder' => "Selecione"
        ));
        $builder->add("quantidadeEquipes");
        $builder->add("quantidadeMinimaJogadores");
        $builder->add("quantidadeMaximaJogadores");
        $builder->add("tipo", ChoiceType::class, array(
            'choices' => array('Torneio' => EdicaoCampeonato::TORNEIO, 'Chave' => EdicaoCampeonato::CHAVE, 'Pontos Corridos'=> EdicaoCampeonato::PONTOS_CORRIDOS),
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
        $builder->add("quantidadeChaves", NumberType::class, array('label'=>'Número de chaves'));
        $builder->add("quantidadeClassificadosChave", NumberType::class, array('label'=>'Classificados por Chave'));
       
        //Passo 2
        $builder->add($builder->create("equipes", CollectionType::class, array(
                'label'         => false,
                'data_class'    => null
        ))->addModelTransformer(new EquipeTransformer($this->manager)));

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EdicaoCampeonato::class,
        ));
    }

    
    
    
}
