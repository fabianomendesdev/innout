<?php
// controller temporário!!!

loadModel('WorkingHours');

$wh = WorkingHours::loadFromUserAndDate(1, date('Y-m-d'));

[$t1, $t2, $t3, $t4] = $wh->getTimes();

print_r($t1);
echo '<br><hr>';
print_r($t2);
echo '<br><hr>';
print_r($t3);
echo '<br><hr>';
print_r($t4);