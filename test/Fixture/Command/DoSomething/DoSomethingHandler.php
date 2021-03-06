<?php declare(strict_types=1);

namespace CQRSTest\Fixture\Command\DoSomething;

class DoSomethingHandler
{
    public function handle(DoSomething $command): string
    {
        // Handling command...
        return $command->getSomethingId();
    }
}