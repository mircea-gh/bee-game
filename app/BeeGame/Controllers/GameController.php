<?php

namespace BeeGame\Controllers;

use BeeGame\Controllers\Controller;
use BeeGame\Models\Bee\Queen;
use BeeGame\Models\Bee\Worker;
use BeeGame\Models\Bee\Drone;
use BeeGame\Models\Swarm;
use BeeGame\Helpers\GameHelper;

class GameController extends Controller
{
    public function index()
    {
        if (!GameHelper::isGameLoaded()) {
            GameHelper::loadGame();
        }

        $gameData = GameHelper::getGameData();

        if (!GameHelper::isGameLoaded() || GameHelper::isGameOver($gameData['aliveBees'])) {
            $this->redirect('player-name');
        }

        if (empty($_GET['action'])) {
            $this->createView('bee-game', $gameData);
            return;
        } 

        $gameData = GameHelper::doAction($_GET['action']);
        $this->createView('bee-game', $gameData);
    }

    public function playerName()
    {
        if (empty($_GET['playerName'])) {
            $this->createView('player-form');
            return;
        }
        
        GameHelper::initSwarm($_GET['playerName']);

        $this->redirect('index.php');
    }
}
