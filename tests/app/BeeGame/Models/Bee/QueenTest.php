<?php

use BeeGame\Models\Bee\Queen;
use PHPUnit\Framework\TestCase;

final class QueenTest extends TestCase
{
    public function testQueenType(): void
    {
        $queen = new Queen(100);

        $this->assertEquals('queen', $queen->type());
    }

    public function testDefaultHealthPoints(): void
    {
        $queen = new Queen(100);

        $this->assertEquals(100, $queen->defaultHealthPoints());
    }

    public function testDefaultDamage(): void
    {
        $queen = new Queen(100);

        $this->assertEquals(8, $queen->defaultDamage());
    }
}
