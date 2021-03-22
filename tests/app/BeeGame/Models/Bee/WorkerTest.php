<?php

use BeeGame\Models\Bee\Worker;
use PHPUnit\Framework\TestCase;

final class WorkerTest extends TestCase
{
    public function testWorkerType(): void
    {
        $worker = new Worker(100);

        $this->assertEquals('worker', $worker->type());
    }

    public function testDefaultHealthPoints(): void
    {
        $worker = new Worker(100);

        $this->assertEquals(75, $worker->defaultHealthPoints());
    }

    public function testDefaultDamage(): void
    {
        $worker = new Worker(100);

        $this->assertEquals(10, $worker->defaultDamage());
    }
}
