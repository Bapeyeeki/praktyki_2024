<?php

function silnia($x) {

    if(!is_string($x)) {

        if($x == 1) {
            return $x;
        } else {
            return $x * silnia($x - 1);
        }
    } else {
        return -1;
    }
}

echo silnia(6);
echo "<br>";

function isPalindrom($str) {

    $cString = preg_replace('/[^a-zA-Z0-9]/', '', strtolower($str));

    $lenght = strlen($cString);

    for ($i = 0; $i < $lenght / 2; $i++) {
        if($cString[$i] != $cString[$lenght - $i - 1]) {
            return "Nie palindrom";
        }
    }
    return "Palindrom";
}


echo isPalindrom("kobyła ma mały bok");