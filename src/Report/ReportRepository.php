<?php declare(strict_types=1);

namespace CQRS\Report;

interface ReportRepository
{
    public function persistReport(Report $report): void;
}
