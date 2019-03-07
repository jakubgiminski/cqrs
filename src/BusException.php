<?php declare(strict_types=1);

namespace CQRS;

use Exception;
use RuntimeException;

class BusException extends RuntimeException
{
    private $name;

    private $parentException;

    public function __construct(string $name, Exception $parentException)
    {
        $this->name = $name;
        $this->parentException = $parentException;
        parent::__construct( "Handling of $name failed with message: {$parentException->getMessage()}");
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getParentExceptionMessage(): string
    {
        return $this->parentException->getMessage();
    }
}
