<?php

class View{

  function __construct(){

  }

  /*
    prompts the user to choose Player vs Player (pvp)
    or Player vs Environment (pve)
  */
  static function getUserModeSelection(){
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
    return $modeInput;
  }

  function printGameMode($mode){
    if($mode == "pvp"){
      echo "Player #1 as [X]\nPlayer #2 as [O]\n";
    }else{
      echo "Player as [X]\nComputer as [O]\n";
    }
  }

  function printBoard($board){
    foreach ($board as &$row){
      foreach ($row as &$cell) {
        echo "| $cell ";
      }
      echo "|\n";
    }
  }

  function printTurn($symbol, $board){
    $this->printBoard($board);
    echo "\n$symbol's turn\n";
  }

  function printComputerMove($move, $symbol){
    echo "The computer chooses to put $symbol in $move\n";
  }

  function getPlayerMove(){
    echo "Select an available cell [1-9]\n";
    $handle = fopen ("php://stdin","r");
    $playerSelection = fgets($handle);
    return $playerSelection;
  }

  function printEndGame($winner, $board){
    if($winner == "tie"){
      echo "Game ended in a tie!\n";
      $this->printBoard($board);
    }else{
      echo "$winner Wins !!\n";
      $this->printBoard($board);
    }
  }

}
