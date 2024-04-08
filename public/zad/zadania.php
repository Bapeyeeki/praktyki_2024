<?php 
$dt = '2020-02-08';
$dt1 = strtotime($dt);

$dt2 = date('l', $dt1);

$dt2 = strtolower($dt2);

if ($dt2 == "saturday" || $dt2 == "sunday") {
    echo "Yes, weekend!";
} else {
    echo "Nie ma!";
}

echo "<br>";
// Write a PHP script to add/subtract the number of days from a particular date. 

echo "Original date : ". $dt;

$days = 10;

$dt3 = strtotime("+".$days." days", strtotime($dt));

echo "<br>". date('Y-m-d', $dt3);

//