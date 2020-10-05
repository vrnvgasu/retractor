<?php

namespace Vrnvgasu\Retractor\Traits;

use Vrnvgasu\Retractor\Jobs\RetractJob;

/**
 * Trait Retractor
 * @package Vrnvgasu\Retractor\Traits
 */
trait Retractor
{
    /**
     * @param null $data
     */
    public function retract($data = null): void
    {
        if (!isset($this->retractorAttempt)) {
            $this->retractorAttempt = 1;
        }

        if (!$this->tryToProvide($data) && ($this->retractorAttempt > 1)) {
            $this->retractorAttempt--;
            RetractJob::dispatch($this, $data)->delay(now()->addMinutes($this->retractorDelay ?? 0));
        }
    }
}
