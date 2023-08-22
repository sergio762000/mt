<?php

namespace ModelTech;

use ModelTech\BaseCar;

class Car extends BaseCar
{
    /**
     * @var int
     */
    private int $passengerSeatsCount;

    public function __construct($carType = 'car', $brand = '', $photoFileName = '', $carrying = 0.0, $passengerSeatsCount = 0)
    {
        parent::__construct($carType, $brand, $photoFileName, $carrying);
        $this->passengerSeatsCount = $passengerSeatsCount;
    }

    /**
     * @return int
     */
    public function getPassengerSeatsCount(): int
    {
        return $this->passengerSeatsCount;
    }

    /**
     * @param int $passengerSeatsCount
     * @return void
     */
    public function setPassengerSeatsCount(int $passengerSeatsCount): void
    {
        $this->passengerSeatsCount = $passengerSeatsCount;
    }

}
