<?php
// Write a PHP script which will display the copyright information in the following format. To get current year you can use the date() function.
// Expected Format : © 2013 PHP Exercises - w3resource

echo "&copy; " . date("Y"). " PHP Exercises - w3resource";

//Create a simple 'birthday countdown' script, the script will count the number of days between current day and birthday

$targets = mktime(0,0,0,6,5,2006);

$today = time();

$licznik = ($targets - $today);

$days = (int)($licznik/86400);
echo "<br>";
echo $days;
echo "<br>";
// Write a PHP script to print the current date in the following format. To get current date's information you can use the date() function.

echo "Current date ". date("Y-m-d");
echo "<br>";

// Write a PHP script to calculate the difference between two dates.

$date1 = "1981-11-04";

$date2 = "2024-09-23";

$date_diff = abs(strtotime($date1) - strtotime($date2));

$years = floor($date_diff / (365*60*60*24));

$months = floor(($date_diff - $years * 365*60*60*24) / (30*60*60*24));

$days = floor(($date_diff - $years * 365*60*60*24 - $months * 30*60*60*24) / (60*60*24));

printf("%d years, %d months, %d days", $years, $months, $days);

// Write a PHP script to convert a date from yyyy-mm-dd to dd-mm-yyyy. 

$correct = date("d-m-Y", strtotime($date2));

echo "<br> ". $correct;

//Write a PHP script to convert the date to timestamp

$timestamp = strtotime($date2);

echo  "<br> ". $timestamp;

// Write a PHP script to calculate a number of days between two dates. 

$to_date = time();
$day_d =  $timestamp - $to_date;

echo "<br>";
echo floor($day_d/(60*60*24));