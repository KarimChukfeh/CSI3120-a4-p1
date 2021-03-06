<?php
/*
  Karim Chukfeh
*/

class GameModel{

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
      array("7", "8", "9"),
    );

    $this->map = array(
      array(0, 0), // 1
      array(0, 1), // 2
      array(0, 2), // 3

      array(1, 0), // 4
      array(1, 1), // 5
      array(1, 2), // 6

      array(2, 0), // 7
      array(2, 1), // 8
      array(2, 2)  // 9
    );

    if($mode == 1){
      $this->mode = "pvp";
    }else{
      $this->mode = "pve";
    }

    $this->turn = "X"; // X gets first move
    $this->over = false;
    $this->winner = "nobody";

  }

  function availableCell($cell){
    $valid = false;
    $key = (int)$cell - 1;
    if($this->map[$key]){
      $row = $this->map[$key][0];
      $col = $this->map[$key][1];
      if($this->board[$row][$col] != "X" and $this->board[$row][$col] != "O"){
        $valid = true;
      }
    }
    return $valid;
  }

  function markCell($cell, $turn){
    $key = (int)$cell - 1;
    $row = $this->map[$key][0];
    $col = $this->map[$key][1];
    $this->board[$row][$col] = $turn;
    $this->switchTurns();
  }

  function switchTurns(){
    if($this->turn == "X"){
      $this->turn = "O";
    }else{
      $this->turn = "X";
    }
  }

  function getComputerMove(){
    $symbol = "O";
    $opSymbol = "X";
    foreach ($this->board as &$row) {
      foreach ($row as $cell) {

        // Check if valid cell
        if($cell !="X" and $cell !="O"){
          $original = $cell; // need it later

          // If it's a winning move then do it
          $this->markCell($cell, $symbol);
          if($this->winCondition($symbol)){
            $this->markCell($cell, $original);
            return $cell;
          }else{ // Original state
            $this->markCell($cell, $original);
          }

          // If it's a blocking move do it
          $this->markCell($cell, $opSymbol);
          if ($this->winCondition($opSymbol)){
            $this->markCell($cell, $original);
            return $cell;
          }else{ // Original state
            $this->markCell($cell, $original);
          }

        }
      }
    }

    // Else do a random move
    foreach ($this->board as &$row) {
      foreach ($row as $cell) {
        if($cell!="X" and $cell!="O"){
          return $cell;
        }
      }
    }
  }

  function isOver(){
    return $this->over;
  }

  function getMode(){
    return $this->mode;
  }

  function getBoard(){
    return $this->board;
  }

  function currentTurn(){
    return $this->turn;
  }

  function getWinner(){
    return $this->winner;
  }

  function endGame($winner){
    $this->winner = $winner;
    $this->over = true;
  }

  function tieCondition(){
    foreach ($this->board as &$row) {
      foreach ($row as &$cell) {
        if($cell != "X" and $cell != "O"){
          return false;
        }
      }
    }
    return true;
  }

  function winCondition($symbol){
    $win = false;

    $win = $this->rowWin($symbol);
    if($win){
      return $win;
    }

    $win = $this->colWin($symbol);
    if($win){
      return $win;
    }

    $win = $this->diagWin($symbol);
    if($win){
      return $win;
    }

    return $win;
  }

  function rowWin($symbol){
    $win = false;
    foreach($this->board as $row){
      if($row[0]==$row[1] and $row[1] == $row[2] and $row[2] == $symbol){
        $win = true;
      }
    }
    return $win;
  }

  function colWin($symbol){
    $win = false;
    for($col=0; $col<3; $col++){
      if($this->board[0][$col] == $this->board[1][$col] and
         $this->board[1][$col] == $this->board[2][$col] and
         $this->board[2][$col] == $symbol)
       { $win = true; }
    }
    return $win;
  }

  function diagWin($symbol){
    $win = false;
    if($this->board[0][0] == $this->board[1][1] and
       $this->board[1][1] == $this->board[2][2] and
       $this->board[2][2] == $symbol)
    { $win = true; }

    if($this->board[0][2] == $this->board[1][1] and
       $this->board[1][1] == $this->board[2][0] and
       $this->board[2][0] == $symbol)
    { $win = true; }

    return $win;
  }

}
