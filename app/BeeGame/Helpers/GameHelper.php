<?php

namespace BeeGame\Helpers;

use BeeGame\Models\Swarm;
use BeeGame\Models\Bee\Queen;
use BeeGame\Models\Bee\Worker;
use BeeGame\Models\Bee\Drone;

class GameHelper
{
    public static function isGameLoaded()
    {
        $playerName = $_SESSION['playerName'] ?? null;
        $swarm = !empty($_SESSION['swarm']) ? unserialize($_SESSION['swarm']) : null;
        if (empty($playerName) || empty($swarm)) {
            return false;
        }
        return true;
    }

    public static function loadGame()
    {
        $gameData = [];

        if (!empty($_COOKIE['gameData'])) {
            $gameData = json_decode($_COOKIE['gameData']);
        }

        foreach ($gameData as $key => $value) {
            if ($key == 'swarm') {
                $_SESSION[$key] = serialize(self::loadSwarm($value));
            } else {
                $_SESSION[$key] = $value;
            }
        }
    }

    public static function initSwarm($playerName)
    {
        $swarm = new Swarm();
        $swarm->addBee(new Queen());
        for ($i = 0; $i < 5; $i++) $swarm->addBee(new Worker());
        for ($i = 0; $i < 8; $i++) $swarm->addBee(new Drone());
        
        self::updateSession([
            'swarm' => serialize($swarm),
            'playerName' => $playerName
        ]);

        self::updateCookies([
            'swarm' => $swarm->toArray(),
            'playerName' => $playerName
        ]);
    }

    public static function loadSwarm($swarmData)
    {
        $swarm = new Swarm();

        foreach ($swarmData as $beeData) {
            $bee = self::createBee($beeData->type, $beeData->healthPoints);
            if (!$bee) continue;
            $swarm->addBee($bee);
        }

        return $swarm;
    }

    public static function createBee($type, $healthPoints)
    {
        switch ($type) {
            case Queen::BEE_TYPE:
                return new Queen($healthPoints);
            case Worker::BEE_TYPE:
                return new Worker($healthPoints);
            case Drone::BEE_TYPE:
                return new Drone($healthPoints);
            default:
                return null;
        }
    }

    public static function getGameData()
    {
        return [
            'swarm' => !empty($_SESSION['swarm']) ? unserialize($_SESSION['swarm']) : null,
            'playerName' => $_SESSION['playerName'] ?? null,
            'latestHitBeeIndex' => $_SESSION['latestHitBeeIndex'] ?? null,
            'aliveBees' => self::getAliveBeesByType(!empty($_SESSION['swarm']) ? unserialize($_SESSION['swarm']) : null)
        ];
    }

    public static function isGameOver($aliveBees)
    {
        return array_sum($aliveBees) == 0;
    }

    public static function getAliveBeesByType($swarm)
    {
        if (empty($swarm)) return [];

        $aliveBees = [];
        $bees = $swarm->getBees();

        foreach ($bees as $bee) {
            if (!$bee->isAlive()) continue;

            if (!isset($aliveBees[$bee->type()])) {
                $aliveBees[$bee->type()] = 0;
            }

            $aliveBees[$bee->type()] += 1;
        }

        return $aliveBees;
    }

    public static function doAction($action)
    {
        switch ($action) {
            case 'hit':
                self::hitSwarm();
                break;
            default: break;
        }
        return self::getGameData();
    }

    public static function hitSwarm()
    {
        $swarm = unserialize($_SESSION['swarm']);
        $bees = $swarm->getBees();

        $aliveBees = array_filter($bees, function($bee) {
            return $bee->isAlive();
        });
        $aliveBeesKeys = array_keys($aliveBees);

        $randomBeeIndex = array_rand($aliveBeesKeys);
        $randomBeeIndex = $aliveBeesKeys[$randomBeeIndex];
        $randomBee = $swarm->getBee($randomBeeIndex);

        $randomBee->damage($randomBee->defaultDamage());
        if ($randomBee->type() == Queen::BEE_TYPE && $randomBee->getHealthPoints() == 0) {
            foreach ($bees as $bee) {
                $bee->setHealthPoints(0);
            }
        }

        self::updateSession([
            'swarm' => serialize($swarm),
            'latestHitBeeIndex' => $randomBeeIndex
        ]);

        self::updateCookies([
            'swarm' => $swarm->toArray(),
            'playerName' => $_SESSION['playerName'] ?? null,
            'latestHitBeeIndex' => $randomBeeIndex
        ]);

        return self::getGameData();
    }

    public static function updateSession($data)
    {
        foreach ($data as $key => $value) {
            $_SESSION[$key] = $value;
        }
    }

    public static function updateCookies($data)
    {
        setcookie('gameData', json_encode($data), time() + 24 * 60 * 60, '/; samesite=strict');
    }
}