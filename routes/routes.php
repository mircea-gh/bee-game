<?php

use BeeGame\Route;

Route::set('index.php', 'BeeGame\Controllers\GameController', 'index');
Route::set('player-name', 'BeeGame\Controllers\GameController', 'playerName');
