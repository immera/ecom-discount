<?php
namespace Immera\EcomDiscount\Serices\Traits;

trait DiscountableOrder {

    public function getAmount(): float | int
    {
        return 0;
    }

    public function getQuentity(): int
    {
        return 0;
    }

}