<?php

namespace App\Traits;

trait ProgressBar
{
    protected function startProgress(int $total): void
    {
        $this->total = $total;
        $this->current = 0;
        echo "Starting...\n";
        $this->showProgress();
    }

    protected function advanceProgress(int $step): void
    {
        $this->current += $step;
        $this->showProgress();
    }

    private function showProgress(): void
    {
        $percent = ($this->current / $this->total) * 100;
        echo sprintf("\rProgress: %.2f%% (%d/%d)", $percent, $this->current, $this->total);
    }
}
