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
    
    public function reverseTransform($data)
    {
        $collection = new ArrayCollection();
        
        foreach ($data as $value) {
            if (is_numeric($value)) {
                $parameters = array('id' => $value);
            } else {
                $parameters = array('nome' => $value);
            }
            $equipe = $this->em
                ->getRepository(Equipe::class)
                ->findOneBy($parameters);

            if (empty($equipe)) {
                $equipe = new Equipe($value);
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
