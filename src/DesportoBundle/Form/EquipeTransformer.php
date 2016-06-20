<?php

namespace DesportoBundle\Form;

use DesportoBundle\Entity\Equipe;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Description of EquipeTransformer
 *
 * @author Luciano
 */
class EquipeTransformer implements DataTransformerInterface
{
    
    /**
     * @var EntityManager
     */
    private $em;
    
    /**
     * @param EntityManager $em
     */
    public function __construct(EntityManager  $em)
    {
        $this->em = $em;
    }
    
    public function reverseTransform($value)
    {
        $collection = new ArrayCollection();
        
        foreach ($value as $nome) {
            $equipe = $this->em
                    ->getRepository(Equipe::class)
                    ->findOneBy(array('nome' => $nome, 'dataExclusao' => null));
            if (empty($equipe)) {
                $equipe = new Equipe($nome);
            }
            $collection->add($equipe);
        }
        
        return $collection;
    }

    public function transform($equipes)
    {
        if (is_null($equipes)) {
            return null;
        }
        $arrayEquipes = [];
        foreach ($equipes as $equipe) {
            $arrayEquipes[] = $equipe->getNome();
        }
        return $arrayEquipes;
    }

    
}
