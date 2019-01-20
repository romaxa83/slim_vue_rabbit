<?php

declare(strict_types=1);

namespace Api\Infrastructure\Doctrine\Type\User;

use Api\Model\User\Entity\User\UserId;
use Doctrine\DBAL\Platforms\AbstractPlatform;
use Doctrine\DBAL\Types\GuidType;

class UserIdType extends GuidType
{
    //имя которое испоьзуеться в конфиге для регистрации в doctrine (config/common/doctrine)
    // после чего их можно использовать при названии типа данных при маппинге
    public const NAME = 'user_user_id';

    //конвертирует значение из сущьности в бд 
    public function convertToDatabaseValue($value, AbstractPlatform $platform)
    {
        return $value instanceof UserId ? $value->getId() : $value;
    }

    //конвертирует значение из бд в сущьность
    public function convertToPHPValue($value, AbstractPlatform $platform)
    {
        return !empty($value) ? new UserId($value) : null;
    }

    public function getName(): string {
        return self::NAME;
    }
}