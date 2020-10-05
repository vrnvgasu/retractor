<?php

namespace Vrnvgasu\Retractor\Tests\Unit;

use Illuminate\Support\Facades\Queue;
use Tests\TestCase;
use Vrnvgasu\Retractor\Interfaces\Retractable;
use Vrnvgasu\Retractor\Jobs\RetractJob;
use Vrnvgasu\Retractor\Traits\Retractor;

/**
 * Class RetractorTest
 * @package Vrnvgasu\Retractor\tests
 */
class RetractorTest extends TestCase
{
    public function testRetractSuccess(): void
    {
        Queue::fake();

        $class = $this->getClass();

        $class->retract(1);

        Queue::assertNotPushed(RetractJob::class, function ($job) {
            return ! is_null($job->delay);
        });
    }

    public function testRetractFailed(): void
    {
        Queue::fake();

        $class = $this->getClass();

        $class->retract(false);

        Queue::assertPushed(RetractJob::class, function ($job) {
            return ! is_null($job->delay);
        });
    }

    /**
     * @return Retractable
     */
    private function getClass(): Retractable
    {
        return new class implements Retractable {
            use Retractor;

            private $retractorAttempt = 5;
            private $retractorDelay = 5;

            public function tryToProvide($data = null): bool
            {
                return $data;
            }
        };
    }
}
