<?php

namespace BeeGame\Models;

use BeeGame\Models\Bee\Bee;
use Exception;

class Swarm
{
    private $bees = [];

    public function isEmpty()
    {
        return empty($this->bees);
    }

    public function addBee(Bee $bee)
    {
        $this->bees[] = $bee;
    }

    public function removeBee(int $index)
    {
        if (!isset($this->bees[$index])) {
            throw new Exception('Undefined offset: ' . $index);
        }
        $removedBees = array_slice($this->bees, $index, 1);
        return $removedBees[0];
    }

    public function getBee(int $index)
    {
        if (!isset($this->bees[$index])) {
            throw new Exception('Undefined offset: ' . $index);
        }
        return $this->bees[$index];
    }

    public function getBees()
    {
        return $this->bees;
    }

    public function toArray()
    {
        $swarm = [];
        foreach ($this->bees as $bee) {
            $swarm[] = [
                'type' => $bee->type(),
                'healthPoints' => $bee->getHealthPoints()
            ];
        }
        return $swarm;
    }
}
