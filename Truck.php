<?php

namespace ModelTech;

use ModelTech\BaseCar;

class Truck extends BaseCar
{
    /**
     * @var float
     */
    private float $bodyWidth;
    /**
     * @var float
     */
    private float $bodyHeight;
    /**
     * @var float
     */
    private float $bodyLength;

    public function __construct($carType = '', $brand = '', $photoFileName = '', $carrying = 0.0, $bodyWidth = 0.0, $bodyHeight = 0.0, $bodyLength = 0.0)
    {
        parent::__construct($carType, $brand, $photoFileName, $carrying);
        $this->bodyWidth = $bodyWidth;
        $this->bodyHeight = $bodyHeight;
        $this->bodyLength = $bodyLength;
    }
    
    /**
     * @return float
     */
    public function getBodyWidth(): float
    {
        return $this->bodyWidth;
    }

    /**
     * @param float $bodyWidth
     * @return void
     */
    public function setBodyWidth(float $bodyWidth): void
    {
        $this->bodyWidth = $bodyWidth;
    }

    /**
     * @return float
     */
    public function getBodyHeight(): float
    {
        return $this->bodyHeight;
    }

    /**
     * @param float $bodyHeight
     * @return void
     */
    public function setBodyHeight(float $bodyHeight): void
    {
        $this->bodyHeight = $bodyHeight;
    }

    /**
     * @return float
     */
    public function getBodyLength(): float
    {
        return $this->bodyLength;
    }

    /**
     * @param float $bodyLength
     * @return void
     */
    public function setBodyLength(float $bodyLength): void
    {
        $this->bodyLength = $bodyLength;
    }

    /**
     * @return float
     */
    public function getBodyVolume(): float
    {
        return $this->bodyLength * $this->bodyWidth * $this->bodyHeight;
    }

}
