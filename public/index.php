<?php

//Silnia
//Napisz funkcję obliczającą silnię 
//liczby podanej jako parametr. W przypadku błędnego parametru funkcja powinna zwrócić -1

function silnia ($x) {
	
	if (!is_string($x)) {
		
        if($x == 1){
            return 1;
        }else {
            return $x * silnia($x -1);
        }

	} else {
		return -1;
	}
}

echo silnia(5);
echo "<br>";
echo "-----------------";
echo "<br>";

for($x = 1; $x <=50; $x++){
    if($x % 4 ==0 && $x % 5 == 0 ){

        echo "YingYang ";

    } elseif($x % 5 == 0){

        echo "Yang ";

    } elseif($x % 4 == 0){

        echo "Ying ";

    } else{

        echo $x. " ";
    }
}

function test($a) {
    echo $a;
}

$a = 5;
$b = 15;

test($a++);

test(++$b);

echo "<br>";

$wyniki = [];
$fibo = 0;


function fibonaci($x){    
    global $wyniki, $fibo;

    if (isset($wyniki[$x])) {
        return $wyniki[$x];
    }

    $fibo++;

    if ($x == 0 || $x == 1) {
        $wyniki[$x] = $x;
        return $x;
      }
      else {
        $wyniki[$x] = fibonaci($x - 1) + fibonaci($x - 2);
        return $wyniki[$x];
      }
}

echo fibonaci(4);

echo '-----';
echo $fibo;

