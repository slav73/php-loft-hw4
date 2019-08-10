<?php
namespace CarShare;

include("init.php");

$baseTariff = new BaseTariff(0, 60, 16, 7, 1);

echo $baseTariff->orderMessage();

$hourTariff = new HourTariff(5, 60, 22, 1, 2);

echo $hourTariff->orderMessage();

$hourTariff = new HourTariff(5, 121, 18, 1, 1);

echo $hourTariff->orderMessage();

$dayTariff = new DayTariff(-1505, 1471, 18, 1, 1);

echo $dayTariff->orderMessage();

$studentTariff = new StudentTariff(5, 10, 25, 1, 0);

echo $studentTariff->orderMessage();