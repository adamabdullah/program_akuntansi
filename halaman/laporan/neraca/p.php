<?php $start = $month = strtotime('2009-02-01');
$end = strtotime('2011-01-01');
while($month < $end)
{
     echo date('F Y', $month), PHP_EOL;
     $month = strtotime("+1 month", $month);
} ?>