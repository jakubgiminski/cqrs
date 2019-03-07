<?php declare(strict_types=1);

namespace CQRS;

interface NamedResource
{
    public static function getName(): string;
}
