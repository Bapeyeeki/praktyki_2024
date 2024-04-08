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
echo "<br>";

// Write a PHP script to calculate weeks between two dates. 

function week_between_two_dates($date1, $date2)
{
    $first = DateTime::createFromFormat('m/d/Y', $date1);
    $second = DateTime::createFromFormat('m/d/Y', $date2);
    
    if($date1 > $date2) return week_between_two_dates($date2, $date1);
    
    return floor($first->diff($second)->days/7);
}

$dt1 = '1/1/2014';
$dt2 = '12/31/2014';

echo 'Weeks between '.$dt1.' and '. $dt2. ' is '. week_between_two_dates($dt1, $dt2)."<br>";

// Write a PHP script to get the number of the month before the current month.

echo date('n', strtotime('-1 month')). "<br>";

// Write a PHP script to convert seconds into days, hours, minutes and seconds. 

function convert_seconds($seconds) 
 {
  $dt1 = new DateTime("@0");
  $dt2 = new DateTime("@$seconds");
  
  $diff = $dt1->diff($dt2);
  
  return $diff->format('%a days, %h hours, %i minutes and %s seconds');
 }

echo convert_seconds(200000)."<br>";

// Write a PHP script to get the last 6 months from the current month. 

$months = [];

for ($i = 6; $i >= 1; $i--) 
{
    $date = date('Y-n', strtotime(date('Y-n') . " -$i months"));
    
    $months[] = $date;
}

var_dump($months);

// -------------------------

echo date("M - Y")."\n";

echo date("M - Y",strtotime("-1 Month"))."\n";

echo date("M - Y",strtotime("-2 Months"))."\n";

echo date("M - Y",strtotime("-3 Months"))."\n";

// Write a PHP script to convert the number to month name. 

$month_num = 5;

$dateObj = DateTime::createFromFormat('!m',$month_num);

$month_name = $dateObj->format('F');


echo "<br>".$month_name;


