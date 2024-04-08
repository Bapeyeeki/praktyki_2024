<?php
// zadania

//phpinfo();

$color  = ['white','green','red','blue','black'];

echo "The memory of that scene for me is like a frame of film forever frozen at that moment: the ".
$color[3] ." carpet, the ". $color[1]. " lawn, the ". $color[0] ." house, the leaden sky. The new president and his first lady. - Richard M. Nixon";


// zadanie 3
foreach($color as $item)
{
    echo $item. "<br>";
}

// zadanie 4
try{
    $numerator = 100;
    $denominator = 25;

    if($denominator === 0) {
        throw new Exception("Division by zero is not allowed");
    }

    $result = $numerator / $denominator;
    echo "Result: ". $result;
} catch (Exception $e) {
    echo "An error occurred: ". $e->getMessage();
}

echo "<br>";

function validateString($inputString) {
    if(empty($inputString)) {
        throw new Exception("String should not be empty!");
    }
}

try {
    $string = "";
    validateString($string);
    echo "Valid string: ". $string;
} catch (Exception $e) {
    echo "An error occurred ". $e->getMessage();
}