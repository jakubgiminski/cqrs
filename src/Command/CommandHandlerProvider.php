<?php declare(strict_types=1);

namespace CQRS\Command;

use CQRS\Command\Config\RegisteredCommands;
use Psr\Container\ContainerInterface as Container;

class CommandHandlerProvider
{
    /** @var RegisteredCommands */
    private $registeredCommands;

    /** @var Container */
    private $container;

    public function __construct(RegisteredCommands $registeredCommands, Container $container)
    {
        $this->registeredCommands = $registeredCommands;
        $this->container = $container;
    }

    public function getForCommand(string $commandName)
    {
        $handler = $this->container->get(
            (string) $this->registeredCommands->getByName($commandName)->getHandlerClassName()
        );

        return $handler;
    }
}

