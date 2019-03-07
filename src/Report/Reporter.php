<?php declare(strict_types=1);

namespace CQRS\Report;

use Exception;

interface Reporter
{
    public function reportSuccess(string $message): void;

    public function reportError(Exception $exception): void;
}
