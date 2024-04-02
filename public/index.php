<?php

//Silnia
//Napisz funkcję obliczającą silnię 
//liczby podanej jako parametr. W przypadku błędnego parametru funkcja powinna zwrócić -1

function silnia ($x) {
	
	if (!is_string($x)) {
		
		$result = 1;
			
		for($j = 1; $j <=$x; $j++) {
			$result *= $j;
		}
		
		return $result;

	} else {
		return -1;
	}
}

echo silnia(4);
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