<?php
namespace CarShare;

include("interface.price.php");
include("trait.ageValidation.php");
include("trait.timeValidation.php");
include("trait.distanceValidation.php");
include("trait.gps.php");
include("trait.driver.php");


abstract class Tariffs implements Price
{
    protected $_pricePerKm = 10;
    protected $_pricePerMinute = 3;
    
    protected $_age;
    protected $_distance;
    protected $_time;
    protected $_hours;
    protected $_days;
    protected $_risky1;
    protected $_gps;
    protected $_driver;
    
    public function __construct($distance = 0, $time = 0, $age = 18, $gps = 1, $driver = 0)
    {
        $this->_distance = $distance;
        $this->_time = TimeValidation::validTime($time);
        $this->_hours = ceil($this->_time / self::HOUR);
        $this->_days = ceil($this->_time / self::DAY);
        $this->_age = $age;
        $this->_gps = Gps::calcGps($this->_hours, $gps);
        $this->_driver = Driver::addDriver($driver);
 
        $this->_distance = DistanceValidation::validDistance($distance);
         
        $this->_age <= self::RISKY_AGE ? $this->_risky = 1.1 : $this->_risky = 1;
    }
    
    abstract public function orderMessage();

}


