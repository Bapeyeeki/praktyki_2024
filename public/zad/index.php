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

// Write a PHP script to get the first and last day of a month from a specified date. 

echo "<br>First day: ". date("Y-m-01", $timestamp) . " Last day ". date("Y-m-t", $timestamp);
echo "<br>";

// Write a PHP script to print like : Saturday the 7th. 

echo date('l \t\h\e jS'). "<br>";

// Write a PHP script to check whether the given dates are valid or not? 
var_dump(checkdate(2,29,2008));

// Write a PHP script to get time difference in days and years, months, days, hours, minutes, seconds between two dates.

$date3 = new DateTime('2012-06-01 02:12:51'); 
$date4 = $date3->diff(new DateTime('2014-05-12 11:10:00')); 
echo $date4->days.' Total days'."\n"; 
echo $date4->y.' years'."\n"; 
echo $date4->m.' months'."\n"; 
echo $date4->d.' days'."\n"; 
echo $date4->h.' hours'."\n"; 
echo $date4->i.' minutes'."\n"; 
echo $date4->s.' seconds'."\n";

echo "<br>";

//Write a PHP script to change month number to month name. 
$month_num = 11; 
$month_name = date("F", mktime(0, 0, 0, $month_num, 10)); 
echo $month_name."\n"; 
echo "<br>";


// Write a PHP script to get yesterday's date. 
$dt = new DateTime(); 
$dt->sub(new DateInterval('P1D')); 
echo $dt->format('F j, Y')."\n";
echo "<br>";

// Write a PHP script to get the current date/time of 'Australia/Melbourne'. 
