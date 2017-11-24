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
      if($this->colCondition($candidate) and $this->rowCondition($candidate) and $this->diagConditionA($candidate)  and $this->diagConditionB($candidate)){
        $this->grid[$candidate] = "Q";
        $queens++;
      }
      $count++;
      if($count > 500){
        $this->shuffle();
        $queens = 0;
        $count = 0;
      }
    }
  }

  function printGrid(){
    for($cell= 0; $cell<64; $cell++){
      if($cell%8 == 0){
        echo "\n";
      }
      echo "[";
      echo $this->grid[$cell];
      echo "]";
      echo " ";
    }
  }

  function shuffle(){
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
    $check = $candidate;
    while($check >= 0){
      $temp = $check;
      $check = $check - 8;
    }
    $check = $check + 8;

    $colEnds = $check + 56;
    for($check; $check<=$colEnds; $check+=8){
      if($this->grid[$check] != '-'){
        return false;
      }
    }

    return true;
  }

  function rowCondition($candidate){
    $check = $candidate;
    while(!($check%8 == 0)){
      $check = $check - 1;
    }

    $rowEnds = $check + 8;
    for($check; $check<$rowEnds; $check++){
      if($this->grid[$check] != '-'){
        return false;
      }
    }

    return true;
  }

  function diagConditionA($candidate){
    $checkA = $candidate;
    while($checkA > 0 and !($checkA%8 == 0)){
      $temp = $checkA;
      $checkA = $checkA - 9;
    }
    if($checkA < 0){
      $checkA = $temp;
    }

    $diagEndsA = $checkA;
    while($diagEndsA < 63 and !(($diagEndsA+1)%8 == 0)){
      $diagEndsA = $diagEndsA + 9;
    }

    for($checkA; $checkA<$diagEndsA; $checkA+=9){
      if($this->grid[$checkA] != '-'){
        return false;
      }
    }
    return true;
  }

  function diagConditionB($candidate){
    $check = $candidate;
    while($check >= 0 and !(($check+1) %8 == 0)){
      $temp = $check;
      $check = $check - 7;
    }
    if($check < 0){
      $check = $temp;
    }

    $diagEnds = $check;
    while($diagEnds < 63 and !($diagEnds %8 == 0)){
      $diagEnds = $diagEnds + 7;
    }

    for($check; $check < $diagEnds; $check += 7){
      if($this->grid[$check] != '-'){
        return false;
      }
    }
    return true;
  }

}

/////////////
// GO TIME //
/////////////
$queens = new Queens;
$queens->printGrid();
