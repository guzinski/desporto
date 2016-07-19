<?php

namespace DesportoBundle\Form;

use DesportoBundle\Doctrine\Type\EnumSexoType;
use DesportoBundle\Entity\Campeonato;
use DesportoBundle\Entity\EdicaoCampeonato;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
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
        $builder->add("edicao", TextType::class, ["label"=>"Edição (Ano/Número)"]);
        $builder->add("campeonato", EntityType::class, array(
            'class' => Campeonato::class,
            'placeholder' => "Selecione"
            
        ));
        $builder->add("modalidade", ChoiceType::class, array(
            'choices' => array('Feminino' => EnumSexoType::FEMININO, 'Masculino' => EnumSexoType::MASCULINO),
            'placeholder' => "Selecione"
        ));
        $builder->add("quantidadeEquipes", NumberType::class);
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
        $builder->add("faseDeGrupos", ChoiceType::class, array(
            'choices' => ['Turno'=> "T", "Returno"=>"R"],
            'placeholder' => "Selecione",
        ));
        $builder->add("oitavas", ChoiceType::class, array(
            'choices' => ['Somente ida'=> "S", "Ida e volta"=>"I"],
            'placeholder' => "Selecione",
        ));
        $builder->add("quartas", ChoiceType::class, array(
            'choices' => ['Somente ida'=> "S", "Ida e volta"=>"I"],
            'placeholder' => "Selecione",
        ));
        $builder->add("semifinal", ChoiceType::class, array(
            'choices' => ['Somente ida'=> "S", "Ida e volta"=>"I"],
            'placeholder' => "Selecione",
        ));
        $builder->add("final", ChoiceType::class, array(
            'choices' => ['Somente ida'=> "S", "Ida e volta"=>"I"],
            'placeholder' => "Selecione",
        ));
        $builder->add("quantidadeChaves", ChoiceType::class, array(
            'label'=>'Número de chaves',
            'placeholder'=>"Selecione",
            'choices' => ['1'=>'1','2'=>'2','7'=>'4','8'=>'8','16'=>'16']
        ));
        $builder->add("quantidadeClassificadosChave", ChoiceType::class, array(
            'label'=>'Classificados por Chave',
            'placeholder'=>"Selecione",
            'choices' => ['1'=>'1','2'=>'2','7'=>'4','8'=>'8','16'=>'16']
        ));
       
        //Passo 2
        $builder->add($builder->create("equipes", CollectionType::class, array(
                'label'         => false,
                'data_class'    => null,
                'allow_add' => true,
        ))->addModelTransformer(new EquipeTransformer($this->manager)));
        $builder->add($builder->create("chaves", CollectionType::class, array(
                'entry_type'    => ChaveType::class,
                'allow_add'     => true,
                'label'         => false,
        )));
        $builder->add($builder->create("fasesClassificatorias", CollectionType::class, array(
                'entry_type'    => FaseClassificatoriaType::class,
                'allow_add'     => true,
                'label'         => false,
        )));

        
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => EdicaoCampeonato::class,
        ));
    }

    
    
    
}
