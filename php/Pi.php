<?php
$yes = 0;
$total = 0;
echo "\nEstimating 100000 points\n";
for($i=0; $i < 100000; $i++){
  $x = random_int(0, 2 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX );
  $y = random_int(0, 2 - 1) + (random_int(0, PHP_INT_MAX - 1) / PHP_INT_MAX );
  if(pow(abs($x-1), 2) + pow(abs($y-1), 2)  <  pow(1, 2)){
    $yes++;
  }
  $total++;
}
echo "Number of points inside a circle of radius 1: $yes\n";
$pi = 4*($yes/$total);
echo "Pi estimate: $pi";
