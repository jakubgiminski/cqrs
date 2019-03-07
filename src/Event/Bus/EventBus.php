<?php declare(strict_types=1);

namespace CQRS\Event\Bus;

use CQRS\BusException;
use CQRS\Command\CommandHandlerProvider;
use Exception;

class EventBus
{
    private $registeredEvents;

    private $handlerProvider;

    public function __construct(RegisteredEvents $registeredEvents, CommandHandlerProvider $handlerProvider)
    {
        $this->registeredEvents = $registeredEvents;
        $this->handlerProvider = $handlerProvider;
    }

    public function handle($event)
    {
        $this->registeredEvents->mustContain($event);

        $handler = $this->handlerProvider->get(
            $this->registeredEvents->getHandlerClassName($event)
        );

        try {
            return $handler->handle($event);
        } catch (Exception $exception) {
            throw BusException::handlingFailed(get_class($event), $exception);
        }
    }
}