
<?php

include("class.tariffs.php");

$baseTariff = new BaseTariff(-5, 70, 22, 1);

echo $baseTariff->orderMessage();

$hourTariff = new HourTariff(5, 60, 22, 1, 1);

echo $hourTariff->orderMessage();

$hourTariff = new HourTariff(5, 121, 25, 0, 0);

echo $hourTariff->orderMessage();

$dayTariff = new DayTariff(5, 1471, 44, 0, 1);

echo $dayTariff->orderMessage();

$studentTariff = new StudentTariff(5, 13, 24, 0, 1);

echo $studentTariff->orderMessage();