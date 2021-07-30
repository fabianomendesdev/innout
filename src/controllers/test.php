<?php
// controller temporário!!!

loadModel('WorkingHours');

$wh = WorkingHours::loadFromUserAndDate(1, date('Y-m-d'));

$workedIntervalString = $wh->getWorkedInterval()->format('%H:%I:%S');

print_r($workedIntervalString);

echo '<br>';

$lunchInterval = $wh->getLunchInterval()->format('%H:%I:%S');

print_r($lunchInterval);

echo '<br>';

$exitTime = $wh->getExitTime()->format('H:i:s');

print_r($exitTime);