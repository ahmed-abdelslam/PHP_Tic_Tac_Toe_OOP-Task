<?php 

    // Start the session
    session_start();

    require 'Classes/Game.php';

    use Classes\Game;

    $game = new Game;

    // save this object in a session variable
    $_SESSION['game_obj'] = $game;
