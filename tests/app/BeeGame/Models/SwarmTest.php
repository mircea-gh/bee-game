<?php

use BeeGame\Models\Swarm;
use BeeGame\Models\Bee\Bee;
use BeeGame\Models\Bee\Queen;
use PHPUnit\Framework\TestCase;

final class SwarmTest extends TestCase
{
    private $swarm;
    private $queen;

    public function setUp(): void
    {
        $this->swarm = new Swarm();
        $this->queen = new Queen(100);
    }

    public function testNewSwarmIsEmpty(): void
    {
        $this->assertTrue($this->swarm->isEmpty());
    }

    public function testAddBee(): void
    {
        $this->swarm->addBee($this->queen);
        $this->assertFalse($this->swarm->isEmpty());
    }

    public function testExceptionRemoveBee(): void
    {
        $beeIndex = 7;
        $this->expectException(Exception::class);
        $this->swarm->removeBee($beeIndex);
    }

    public function testRemoveBee(): void
    {
        $this->swarm->addBee($this->queen);
        $bee = $this->swarm->removeBee(0);
        $this->assertInstanceOf(Bee::class, $bee);
        $this->assertEquals(100, $bee->getHealthPoints());
    }

    public function testExceptionGetBee(): void
    {
        $this->expectException(Exception::class);
        $this->swarm->getBee(7);
    }

    public function testGetBee(): void
    {
        $this->swarm->addBee($this->queen);
        $bee = $this->swarm->getBee(0);
        $this->assertInstanceOf(Bee::class, $bee);
        $this->assertEquals(100, $bee->getHealthPoints());
    }
}
