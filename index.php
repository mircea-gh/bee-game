<?php

session_start();

require_once __DIR__ . '/app/BeeGame/Models/Bee/Bee.php';
require_once __DIR__ . '/app/BeeGame/Models/Bee/Queen.php';
require_once __DIR__ . '/app/BeeGame/Models/Bee/Worker.php';
require_once __DIR__ . '/app/BeeGame/Models/Bee/Drone.php';
require_once __DIR__ . '/app/BeeGame/Models/Swarm.php';
require_once __DIR__ . '/app/BeeGame/Controllers/Controller.php';
require_once __DIR__ . '/app/BeeGame/Controllers/GameController.php';
require_once __DIR__ . '/app/BeeGame/Helpers/GameHelper.php';
require_once __DIR__ . '/app/BeeGame/Route.php';

require_once __DIR__ . '/routes/routes.php';

?>
