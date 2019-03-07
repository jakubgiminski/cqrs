<?php declare(strict_types=1);

namespace CQRS\Command\Report;

use CQRS\Report\Reporter;
use CQRS\Report\ReportRepository;
use Exception;

class CommandBusReporter implements Reporter
{
    private $reportRepository;

    public function __construct(ReportRepository $reportRepository)
    {
        $this->reportRepository = $reportRepository;
    }

    public function reportSuccess(string $commandName): void
    {
        $this->reportRepository->persistReport(
            CommandBusReport::success($commandName)
        );
    }

    public function reportError(Exception $exception): void
    {
        $this->reportRepository->persistReport(
            CommandBusReport::error($exception)
        );
    }
}