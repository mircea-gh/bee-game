<?php

namespace BeeGame\Models\Bee;

class Queen extends Bee
{
    const BEE_TYPE = 'queen';
    const DEFAULT_HP = 100;
    const DEFAULT_DAMAGE = 8;

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
