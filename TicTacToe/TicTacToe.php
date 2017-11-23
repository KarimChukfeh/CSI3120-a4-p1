<?php
/*
  The TicTacToe class contains instances of the model/view/controller
  required to play Tic Tac Toe in console
*/
include('model.php');
include('view.php');
include('controller.php');
class TicTacToe{

  protected $model;
  protected $view;
  protected $controller;

  function __construct(){

    // Ask the user for a game mode
    $this->gameMode = View::getUserModeSelection();

    // MVC initiation
    $this->model = new Model($this->gameMode);
    $this->view = new View($this->model);
    $this->controller = new Controller($this->model, $this->view);

    // Let's play
    $this->play();
  }


  function play(){
    $this->view->printGameMode();

    // Take turns until game is over
    while(!$this->model->isOver()){
      $this->view->printBoard();
      $this->view->printTurn($this->model->getTurn());
      $this->controller->takeTurn($this->model->getTurn());
    }
    $this->view->printEndGame();
  }
}


// It's go time
new TicTacToe;
