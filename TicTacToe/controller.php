<?php

class Controller{

  protected $model;
  protected $view;

  function __construct($model, $view){
    $this->model = $model;
    $this->view = $view;
  }

  function play(){

    // Welcome screen
    $this->view->printGameMode($this->model->getMode());

    // Take turns until game is over
    while(!$this->model->isOver()){

      // Show the board
      $this->view->printTurn($this->model->currentTurn(), $this->model->getBoard());
      // Play next turn
      $this->takeTurn();
    }
    // Show the end score
    $this->view->printEndGame($this->model->getWinner(), $this->model->getBoard());
  }

  function takeTurn(){

    $symbol = $this->model->currentTurn();
    $mode = $this->model->getMode();

    if($mode == "pve" and $symbol == "O"){
      // Computer logic is in the model
      $move = $this->model->getComputerMove();
      // Show computer decision
      $this->view->printComputerMove($move, $symbol);
    }else{
      // Prompt current player to select a cell
      $move = $this->view->getPlayerMove();
      // Check if choice is valid
      $valid = $this->model->availableCell($move);
      while(!$valid){
        echo "Invalid Input!\n";
        $this->view->printTurn($symbol, $this->model->getBoard());
        $move = $this->view->getPlayerMove();
        $valid = $this->model->availableCell($move);
      }
    }

    // Change the board
    $this->model->setCell($move, $symbol);

    // Check if game is over
    if($this->model->winCondition($symbol)){
      $this->model->endGame($symbol);
    }elseif ($this->model->tieCondition()) {
      $this->model->endGame("tie");
    }
  }

}
