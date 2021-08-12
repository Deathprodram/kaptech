<?php


namespace App\Services\Transportation;

use App\Services\Transportation\Transportation;

class DHL extends Transportation
{
    private $price = 1000;

    public function calculate() {
        return $this->weight * $this->price;
    }
}
