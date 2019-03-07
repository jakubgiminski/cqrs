<?php declare(strict_types=1);

namespace CQRS\Command\Config;

use Collection\Collection;
use Collection\Type;
use Collection\UniqueIndex;

final class RegisteredCommands extends Collection
{
    public function __construct(array $elements = [])
    {
        parent::__construct($elements, Type::object(CommandConfig::class), new UniqueIndex(function (CommandConfig $commandConfig) {
            return $commandConfig->getCommandName();
        }));
    }

    public function registerCommand(CommandConfig $commandConfig): self
    {
        $this->add($commandConfig);
        return $this;
    }

    public function getByName(string $commandName): CommandConfig
    {
        foreach ($this as $configElement) {
            /** @var CommandConfig */
            if ($configElement->getCommandName() === $commandName) {
                return $configElement;
            }
        }

        // @todo throw exception
    }

    public function getByCommand(string $commandClassName)
    {
        return $this->getBy(function (CommandConfig $commandConfig) use ($commandClassName) {
           return (string) $commandConfig->getCommandClassName() === $commandClassName;
        });
    }

    private function getBy(callable $query)
    {
        foreach ($this as $configElement) {
            if ($query($configElement) === true) {
                return $configElement;
            }
        }

        // @todo throw exception
    }
}