<?php


namespace App\Services\Transportation;

use App\Services\Transportation\Transportation;

class Kazpost extends Transportation
{
    private $prices = [
        'before_10kg' => 100,
        'after_10kg' => 1000,
    ];

    public function calculate() {
        return ($this->weight <= 10)
            ? $this->prices['before_10kg']
            : $this->prices['after_10kg'];
    }
}
