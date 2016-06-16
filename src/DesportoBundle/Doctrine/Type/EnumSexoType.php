<?php

namespace DesportoBundle\Doctrine\Type;

use Doctrine\DBAL\Types\Type;
use Doctrine\DBAL\Platforms\AbstractPlatform;

class EnumSexoType extends Type
{
    
    const ENUM_SEXO = "sexotype";
    const MASCULINO = "M";
    const FEMININO = "F";

    public function getSQLDeclaration(array $fieldDeclaration, AbstractPlatform $platform)
    {
        return "ENUM('F', 'M')";
    }

    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return $value;
    }

    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        if (!in_array($value, array(self::MASCULINO, self::FEMININO))) {
            throw new \InvalidArgumentException("Tipo Inválido");
        }
        return $value;
    }

    public function getName()
    {
        return self::ENUM_SEXO;
    }
}
