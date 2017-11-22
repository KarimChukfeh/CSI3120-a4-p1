<?php

class Model{

  protected $board;
  protected $mode;
  protected $turn;
  protected $winner;
  protected $over;
  protected $map;


  // Construct board
  function __construct($mode){
    $this->board = array(
      array("1", "2", "3"),
      array("4", "5", "6"),
      array("6", "8", "9"),
    );

    $this->map = array(
      array(0, 0),
      array(0, 1),
      array(0, 2),

      array(1, 0),
      array(1, 1),
      array(1, 2),

      array(2, 0),
      array(2, 1),
      array(2, 2)
    );

    if($mode == 1){
      $this->mode = "pvp";
    }else{
      $this->mode = "pve";
    }

    $this->turn = "X"; // X gets first move
    $this->over = false;

  }

  function validMove($move){
    $valid = false;
    $key = $move - 1;
    if($this->map[$key]){
      $row = $this->map[$key][0];
      $col = $this->map[$key][1];
      if($this->board[$row][$col] != "X" and $this->board[$row][$col] != "O"){
        $valid = true;
      }
    }
    return $valid;
  }

  function isOver(){
    return $this->over;
  }

  function endGame($winner){
    $this->winner = $winner;
    $this->over = true;
  }

  function getMode(){
    return $this->mode;
  }

  function getBoard(){
    return $this->board;
  }

  function getTurn(){
    return $this->turn;
  }

}
