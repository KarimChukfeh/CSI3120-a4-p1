<?php

include('model.php');
include('view.php');
include('controller.php');

error_reporting(E_ALL & ~E_NOTICE);
class TicTacToe{

  protected $model;
  protected $view;
  protected $controller;
  protected $gameMode;

  function __construct(){
    // Welcome message
    echo "Welcome to TicTacToe in PHP\n";
    echo "Please type in the mode you'd like to play\n";
    echo "1. Player [X] vs Player [O] \n";
    echo "2. Player [X] vs Computer [O] \n";

    // Mode selection
    $modeInput = 0;
    echo "Mode: ";
    $handle = fopen ("php://stdin","r");
    $modeInput = fgets($handle);
    while(! (($modeInput == 1) or ($modeInput == 2)) ){
      echo "Invalid input.\n";
      echo "Mode: \n";
      echo "1. Player [X] vs Player [O] \n";
      echo "2. Player [X] vs Computer [O] \n";
      $handle = fopen ("php://stdin","r");
      $modeInput = fgets($handle);
    }
    echo "\n";

    // MVC initiation
    $this->model = new Model($modeInput);
    $this->view = new View($this->model);
    $this->controller = new Controller($this->model, $this->view);
  }

  function play(){
    $this->gameMode = $this->model->getMode();
    $this->view->printGameMode();

    // Take turns until game is over
    while(!$this->model->isOver()){
      $this->view->printBoard();
      $this->view->printTurn($this->model->getTurn());
      $this->controller->takeTurn($this->model->getTurn());
      break;
    }
  }
}

$game = new TicTacToe;
$game->play();
