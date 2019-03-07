<?php declare(strict_types=1);

namespace CQRS\Command\Report;

use CQRS\BusException;
use CQRS\Command\CommandBus;
use CQRS\Report\Report;

class CommandBusReport extends Report
{
    public static function success(string $commandName): self
    {
        return new self(
            CommandBus::getName(),
            new \DateTimeImmutable(),
            $commandName,
            true,
            null
        );
    }

    public static function error(BusException $exception): self
    {
        return new self(
            CommandBus::getName(),
            new \DateTimeImmutable(),
            $exception->getName(),
            false,
            $exception->getMessage()
        );
    }
}