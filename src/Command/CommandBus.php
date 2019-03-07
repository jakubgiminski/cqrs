<?php declare(strict_types=1);

namespace CQRS\Command;

use CQRS\BusException;
use CQRS\Command\Report\CommandBusReporter;
use CQRS\NamedResource;
use Exception;

class CommandBus implements NamedResource
{
    private const NAME = 'COMMAND BUS';

    private $handlerProvider;

    private $reporter;

    public function __construct(CommandHandlerProvider $handlerProvider, CommandBusReporter $reporter)
    {
        $this->handlerProvider = $handlerProvider;
        $this->reporter = $reporter;
    }

    public function handle(Command $command)
    {
        try {
            $handler = $this->handlerProvider->getForCommand($command::getName());
            $handler->handle($command);
        } catch (Exception $exception) {
            $exception = new BusException($command::getName(), $exception);
            $this->reporter->reportError($exception);
            throw $exception;
        }
        $this->reporter->reportSuccess($command::getName());
    }

    public static function getName(): string
    {
        return self::NAME;
    }
}