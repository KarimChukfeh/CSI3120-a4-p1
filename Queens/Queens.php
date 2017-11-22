<?php

class Queens{

  protected $grid;

  function __construct(){
    $this->grid = array(
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-'
    );
    $this->buildGrid();
  }

  function buildGrid(){
    $queens = 0;
    $count = 0;
    while($queens<8){
      $candidate = rand(0, 63);
      if($this->colCondition($candidate) and $this->rowCondition($candidate) and $this->diagCondition($candidate)){
        $this->grid[$candidate] = "Q";
        $queens ++;
      }
      $count++;
      if($count > 100){
        $this->resetGrid();
      }
    }
  }

  function printGrid(){
    for($cell= 0; $cell<64; $cell++){
      if($cell%8 == 0){
        echo "\n";
      }
      echo $this->grid[$cell];
      echo "   ";
    }
  }

  function resetGrid(){
    $this->grid = array(
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-',
      '-', '-', '-', '-', '-', '-', '-', '-'
    );
  }

  function colCondition($candidate){

    return true;
  }

  function rowCondition($candidate){
    return true;
  }

  function diagCondition($candidate){
    return true;
  }

}

/////////////
// GO TIME //
/////////////
$queens = new Queens;
$queens->printGrid();
