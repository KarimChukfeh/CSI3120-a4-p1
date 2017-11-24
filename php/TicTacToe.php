<?php

include('mvc/GameModel.php');
include('mvc/GameView.php');
include('mvc/GameController.php');

/*
  The TicTacToe class contains instances of the required classses
  to play Tic Tac Toe in console.
*/
class TicTacToe{
  protected $winner;

  function __construct(){

    // Ask the user for a game mode
    $gameMode = GameView::getUserModeSelection();

    // controller initiation
    $controller = new GameController(new GameModel($gameMode), new GameView);

    // Let's play
    $this->winner = $controller->play();
  }
}

// Main
new TicTacToe;
