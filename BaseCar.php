<?php

namespace ModelTech;

class BaseCar
{
    /**
     * @var string
     */
    protected string $carType;
    /**
     * @var string
     */
    protected string $brand;
    /**
     * @var string
     */
    protected string $photoFileName;
    /**
     * @var float
     */
    protected float $carrying;

    /**
     * @param $carType
     * @param $brand
     * @param $photoFileName
     * @param $carrying
     */
    public function __construct($carType = '', $brand = '', $photoFileName = '', $carrying = 0.0)
    {
        $this->carType = $carType;
        $this->brand = $brand;
        $this->photoFileName = $photoFileName;
        $this->carrying = $carrying;
    }

    /**
     * @param string $type
     * @return void
     */
    public function setCarType(string $type): void
    {
        $this->carType = $type;
    }

    /**
     * @return string
     */
    public function getCarType(): string
    {
        return $this->carType;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param string $brand
     * @return void
     */
    public function setBrand(string $brand): void
    {
        $this->brand = $brand;
    }

    /**
     * @return string
     */
    public function getPhotoFileName(): string
    {
        return $this->photoFileName;
    }

    /**
     * @param string $photoFileName
     * @return void
     */
    public function setPhotoFileName(string $photoFileName): void
    {
        $this->photoFileName = $photoFileName;
    }

    /**
     * @return float
     */
    public function getCarrying(): float
    {
        return $this->carrying;
    }

    /**
     * @param float $carrying
     * @return void
     */
    public function setCarrying(float $carrying): void
    {
        $this->carrying = $carrying;
    }

    /**
     * @return string
     */
    public function getPhotoFileExt(): string
    {
        return explode('.', $this->photoFileName)[1];
    }
}
