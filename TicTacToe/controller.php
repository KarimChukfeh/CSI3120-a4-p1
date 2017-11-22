<?php

class Controller{

  protected $model;
  protected $view;
  protected $map;

  function __construct($model, $view){
    $this->model = $model;
    $this->view = $view;
  }

  function takeTurn($turn){
    if($this->model->getMode() == "pve" and $turn == "O"){
      $this->model->computerMove(); // Computer logic is in the model
    }else{
      $move = $this->view->getPlayerMove();
      $valid = $this->model->validMove($move);
      if($valid){
        echo "valid";
      }
      $board = $this->model->getBoard();
    }

  }

}
