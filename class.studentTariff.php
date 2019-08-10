<?php
namespace CarShare;

class StudentTariff extends BaseTariff 
{
    public function orderMessage()
    {
        $this->_pricePerKm = 4;
        $this->_pricePerMinute = 1;
        if ($this->_age > 25) {
            return ("Ваш возраст не соответствует данному тарифу. Выберите другой тариф!");
        } else {
            if (AgeValidation::ageCheck($this->_age)) {
                $resultingPrice = self::countPrice() + $this->_gps + $this->_driver;
                return ("Тариф студенческий: " . $resultingPrice . PHP_EOL);
            }
        }
    }
}