<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\User;

use Api\Model\User\Entity\User\Email;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\StringType;

class EmailType extends StringType
{
    //имя которое испоьзуеться в конфиге для регистрации в doctrine (config/common/doctrine)
    public const NAME = 'user_user_email';

    //конвертирует значение из сущьности в бд 
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof Email ? $value->getEmail() : $value;
    }

    //конвертирует значение из бд в сущьность
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new Email($value) : null;
    }

    public function getName(): string {
        return self::NAME;
    }
}