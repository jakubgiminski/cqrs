<?php declare(strict_types=1);

namespace CQRS\Command\Config;

use CQRS\ClassName;
use CQRS\Command\Command;

class CommandConfig
{
    private $command;

    private $handler;

    public function __construct(ClassName $command, ClassName $handler)
    {
        self::validateCommand($command);
        $this->command = $command;

        self::validateHandler($handler);
        $this->handler = $handler;
    }

    public static function create(string $command, string $handler): self
    {
        return new self(
            new ClassName($command),
            new ClassName($handler)
        );
    }

    private static function validateCommand(ClassName $command): void
    {
        $command->mustImplement(Command::class);
    }

    private static function validateHandler(ClassName $handler): void
    {
        $handler->mustHaveMethod('handle');
    }

    public function getCommandName(): string
    {
        $commandClassName = (string) $this->command;
        return $commandClassName::getName();
    }

    public function getCommandClassName(): ClassName
    {
        return $this->command;
    }

    public function getHandlerClassName(): ClassName
    {
        return $this->handler;
    }
}