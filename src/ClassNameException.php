<?php declare(strict_types=1);

namespace CQRS;

class ClassNameException extends \RuntimeException
{
    public static function invalidValue(string $class): self
    {

    }

    public static function missingInterface(ClassName $class, ClassName $interface): self
    {

    }

    public static function missingMethod(ClassName $class, string $method): self
    {

    }
}