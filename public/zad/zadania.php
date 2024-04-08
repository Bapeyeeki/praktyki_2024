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

// Write a PHP function to get start and end date of a week (by week number) of a particular year.

function Start_End_Date_of_a_week($week , $year)
{
    $time = strtotime("1 January $year", time());
    $day = date('w', $time);
    $time += ((7*$week)+1-$day)*24*3600;
    $dates[0] = date('Y-n-j', $time);
    $time += 6*24*3600;
    $dates[1] = date('Y-n-j',$time);
    return $dates; 
}

$result = Start_End_Date_of_a_week(12,2024);

echo "<br>";
echo $result[0]."\n";
echo $result[1];

// Write a PHP script to calculate the current age of a person. 
$bday = new DateTime('26.5.2006');
$today = new Datetime(date('m.d.y'));

$diff = $today->diff($bday);

printf(' Your age : %d years, %d month, %d days', $diff->y, $diff->m, $diff->d);
printf("\n"); 