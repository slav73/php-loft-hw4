<?php

include("class.tariffs.php");

$baseTariff = new BaseTariff(5, 60, 20);

echo $baseTariff->countPrice();

$hourTariff = new HourTariff(5, 60, 22);

echo $hourTariff->countPrice();

$hourTariff = new HourTariff(5, 121, 15);

echo $hourTariff->countPrice();
