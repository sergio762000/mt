<?php

namespace ModelTech;

use ModelTech\BaseCar;

class SpecMachine extends BaseCar
{
    private string $extra = '';

    public function __construct($carType = 'spec_machine', $brand = '', $photoFileName = '', $carrying = '', $extra = '')
    {
        parent::__construct($carType, $brand, $photoFileName, $carrying);
        $this->$extra = $extra;
    }
    
    public function getExtra(): string
    {
        return $this->extra;
    }

    public function setExtra(string $extra): void
    {
        $this->extra = $extra;
    }

}