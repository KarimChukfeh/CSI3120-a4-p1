<?php
/*
  The TicTacToe class contains instances of the model/view/controller
  required to play Tic Tac Toe in console
*/
include('model.php');
include('view.php');
include('controller.php');
class TicTacToe{
  protected $winner;

  function __construct(){

    // Ask the user for a game mode
    $gameMode = View::getUserModeSelection();

    // controller initiation
    $controller = new Controller(new Model($gameMode), new View);

    // Let's play
    $this->winner = $controller->play();
  }
}


// It's go time
new TicTacToe;
