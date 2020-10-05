<?php

namespace Vrnvgasu\Retractor\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Vrnvgasu\Retractor\Interfaces\Retractable;

/**
 * Class RetractJob
 * @package Vrnvgasu\Retractor\Jobs
 */
class RetractJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Retractable
     */
    private $retractService;
    private $data;

    /**
     * RetractJob constructor.
     * @param Retractable $retractService
     * @param $data
     */
    public function __construct(Retractable $retractService, $data = null)
    {
        $this->retractService = $retractService;
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $this->retractService->retract($this->data);
    }
}
