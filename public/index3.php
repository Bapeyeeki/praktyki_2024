<?php

function add($x, $y) {
    return $x + $y;
}

echo add($_GET['a'], $_GET['b']);

echo "<br>";



function silnia($x){
    if(!is_string($x))  {
        if($x == 0) {
            return 1;
        }else { 
            return $x * silnia($x - 1);
        }
    } else {
        return -1;
    }
        
}

echo silnia((int) $_GET['a']);


echo "<br>";


