<?php

Class Point{
  protected $x;
  protected $y;

  function __construct($x, $y){
    $this->x = $x;
    $this->y = $y;
  }

  function print(){
    echo "($this->x, $this->y)";
  }

  function getX()
  { return $this->x; }

  function getY()
  { return $this->y; }

}

function random_float($min, $max) {
  return random_int($min, $max - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX );
}

function in_circle($p, $r){
  return (pow(abs($p->getX()-1), 2) + pow(abs($p->getY()-1), 2)  <  pow($r, 2));
}

function estimate_pi($yes, $total){
  return 4*($yes/$total);
}

// Main stuff here
$yes = 0;
$total = 0;
echo "\nEstimating 100000 points\n";
for($i=0; $i < 100000; $i++){
  $p = new Point(random_float(0, 2), random_float(0, 2));
  if(in_circle($p, 1)){
    $yes++;
  }
  $total++;
}
echo "Number of points inside a circle of radius 1: $yes\n";
$pi = estimate_pi($yes, $total);
echo "Pi estimate: $pi";
