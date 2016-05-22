<?php

namespace DesportoBundle\Form;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManager;
use DesportoBundle\Entity\Arquivo;
use Symfony\Component\Form\DataTransformerInterface;

/**
 * Description of ArquivoTransformer
 *
 * @author Luciano
 */
class ArquivoTransformer implements DataTransformerInterface
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
            $arquivo = $this->em
                    ->getRepository(\DesportoBundle\Entity\Arquivo::class)
                    ->findOneBy(array('nome' => $nome));
            if (empty($arquivo)) {
                $arquivo = new Arquivo($nome);
            }
            $collection->add($arquivo);
        }
        
        return $collection;
    }

    public function transform($arquivos)
    {
        $arrayArquivos = [];
        foreach ($arquivos as $arquivo) {
            $arrayArquivos[] = $arquivo->getNome();
        }
        return $arrayArquivos;
    }

    
    
}
