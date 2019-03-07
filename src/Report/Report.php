<?php declare(strict_types=1);

namespace CQRS\Report;

use CQRS\Event\Store\Serializable;

abstract class Report implements Serializable
{
    private $reportedBy;

    private $reportedAt;

    private $action;

    private $successful;

    private $error;

    protected function __construct(string $reportedBy, \DateTimeImmutable $reportedAt, string $action, bool $successful, ?string $error)
    {
        $this->reportedBy = $reportedBy;
        $this->reportedAt = $reportedAt;
        $this->action = $action;
        $this->successful = $successful;
        $this->error = $error;
    }

    public function serialize(): array
    {
        return [
            'reported_by' => $this->reportedBy,
            'reported_at' => $this->reportedAd->getTimestamp(),
            'action' => $this->action,
            'successful' => $this->successful,
            'error' => $this->error,
        ];
    }

    public function __toString(): string
    {
        return json_encode($this->serialize());
    }
}
