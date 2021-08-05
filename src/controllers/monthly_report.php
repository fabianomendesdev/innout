<?php
session_start();
requireValidSession();

$currentDate = new DateTime();
$user = $_SESSION['user'];
$users = null;
$selectedUserId = $user->id;
if($user->is_admin) {
    $users = User::get();
    $selectedUserId = isset($_POST['user']) ? $_POST['user'] : $user->id; 
}

$selectPeriod = isset($_POST['period']) ? new DateTime($_POST['period']) : $currentDate;
$periods = [];
for($yearDiff = 0; $yearDiff <= 2; $yearDiff++){
    $year = new DateTime();
    $year->modify("-$yearDiff year");

    for($month = 12; $month >= 1; $month--){
        $date = new DateTime(strftime('%Y',$year->getTimestamp())."-$month-1");
        $periods[$date->format('Y-m')] = strftime('%B de %Y', $date->getTimestamp());
    }
}

$registries = WorkingHours::getMonthlyReport($selectedUserId, $selectPeriod);

$report = [];
$workday = 0;
$sumOfWorkedTime = 0;
$lastDay = getLastDayOfMonth($selectPeriod)->format('d');

for($day = 1; $day <= $lastDay; $day++) {
    $date = $selectPeriod->format('Y-m') . '-' . sprintf('%02d', $day);
    $registry = $registries[$date];

    if(isPastWorkday($date)) $workDay++;   
    
    if(isset($registry)) {
        $sumOfWorkedTime += $registry->worked_time;
        array_push($report, $registry);
    } else {
        array_push($report, new WorkingHours([
            'work_date' => $date,
            'worked_time' => 0
        ]));
    }
}

$expectedTime = $workDay * DAILY_TIME;
$balance = getTimeStringFromSeconds(abs($sumOfWorkedTime - $expectedTime));

$sing = ($sumOfWorkedTime >= $expectedTime) ? '+' : '-';

loadTemplateView('monthly_report',[
    'report' => $report,
    'sumOfWorkedTime' => getTimeStringFromSeconds($sumOfWorkedTime),
    'balance' => "{$sing}{$balance}",
    'selectedPeriod' => $selectPeriod->format('Y-m'),
    'periods' => $periods,
    'selectedUserId' => $selectedUserId,
    'users' => $users
]);