<?php declare(strict_types=1);

namespace CQRS\Event\Store;

interface Serializable
{
    public function serialize(): array;
}
