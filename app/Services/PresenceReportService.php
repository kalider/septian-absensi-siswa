<?php

namespace App\Services;

interface PresenceReportService {
    public function daily(array $filters): array;
    public function monthly(array $filters): array;
}