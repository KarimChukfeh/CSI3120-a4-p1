<?php

class Controller{

  protected $model;
  protected $view;
  protected $map;

  function __construct($model, $view){
    $this->model = $model;
    $this->view = $view;
  }

  function takeTurn($symbol){
    if($this->model->getMode() == "pve" and $symbol == "O"){
      $move = $this->model->getComputerMove(); // Computer logic is in the model
      $this->view->printComputerMove($move, $symbol);
    }else{
      $move = $this->view->getPlayerMove();
      $valid = $this->model->availableCell($move);
      while(!$valid){
        echo "Invalid Input!\n";
        $this->view->printBoard();
        $this->view->printTurn($symbol);
        $move = $this->view->getPlayerMove();
        $valid = $this->model->availableCell($move);
      }
    }
    $this->model->setCell($move, $symbol);
    if($this->model->winCondition($symbol)){
      $this->model->endGame($symbol);
    }elseif ($this->model->tieCondition()) {
      $this->model->endGame("tie");
    }
  }

}
