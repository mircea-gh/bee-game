<?php

namespace BeeGame\Models\Bee;

abstract class Bee
{
    protected $healthPoints;

    public function __construct(int $healthPoints)
    {
        $this->healthPoints = $healthPoints;
    }

    public abstract function type(): string;
    public abstract function defaultDamage(): int;
    public abstract function defaultHealthPoints(): int;

    public function getHealthPoints(): int
    {
        return $this->healthPoints;
    }

    public function setHealthPoints(int $healthPoints): Bee
    {
        $this->healthPoints = $healthPoints;
        return $this;
    }

    public function damage(int $damage): void
    {
        $this->healthPoints = max(0, $this->healthPoints - $damage);
    }

    public function isAlive(): bool
    {
        return $this->healthPoints > 0;
    }
}
