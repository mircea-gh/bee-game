<?php

namespace BeeGame\Models\Bee;

class Worker extends Bee
{
    const BEE_TYPE = 'worker';
    const DEFAULT_HP = 75;
    const DEFAULT_DAMAGE = 10;

    public function __construct($healthPoints = null)
    {
        parent::__construct($healthPoints ?? self::DEFAULT_HP);
    }

    public function type(): string
    {
        return self::BEE_TYPE;
    }

    public function defaultDamage(): int
    {
        return self::DEFAULT_DAMAGE;
    }

    public function defaultHealthPoints(): int
    {
        return self::DEFAULT_HP;
    }
}
