<?php

class View{

  protected $model;

  function __construct($model){
    $this->model = $model;
  }

  function printGameMode(){
    $mode = $this->model->getMode();
    if($mode == "pvp"){
      echo "Player #1 as [X]\nPlayer #2 as [O]\n";
    }else{
      echo "Player as [X]\nComputer as [O]\n";
    }
  }

  function printBoard(){
    $board = $this->model->getBoard();
    foreach ($board as &$row){
      foreach ($row as &$cell) {
        echo "| $cell ";
      }
      echo "|\n";
    }
  }

  function printTurn($symbol){
    echo "\n$symbol's turn\n";
  }

  function getPlayerMove(){
    echo "Select an available cell [1-9]\n";
    $handle = fopen ("php://stdin","r");
    $playerSelection = fgets($handle);
    return $playerSelection;
  }

}
