<?php

use BeeGame\Models\Bee\Bee;
use PHPUnit\Framework\TestCase;

final class BeeTest extends TestCase
{
    private $stub;

    public function setUp(): void
    {
        $healthPoints = 100;
        $this->stub = $this->getMockForAbstractClass(Bee::class, [ $healthPoints ]);
    }

    public function testBeeType(): void
    {
        $this->stub->expects($this->any())
            ->method('type')
            ->will($this->returnValue('bee'));

        $this->assertEquals('bee', $this->stub->type());
    }

    public function testGetHealthPoints(): void
    {
        $this->assertEquals(100, $this->stub->getHealthPoints());
    }

    public function testSetHealthPoints(): void
    {
        $this->assertInstanceOf(Bee::class, $this->stub->setHealthPoints(50));
        $this->assertEquals(50, $this->stub->getHealthPoints());
    }

    public function testDamage(): void
    {
        $this->stub->damage(10);
        $this->assertEquals(90, $this->stub->getHealthPoints());
    }

    public function testIsAlive(): void
    {
        $this->assertTrue($this->stub->isAlive());
        $this->stub->damage(200);
        $this->assertFalse($this->stub->isAlive());
    }
}
