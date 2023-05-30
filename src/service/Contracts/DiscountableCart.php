<?php
namespace Immera\EcomDiscount\Service\Contracts;

interface DiscountableCart {
    public function getAmount(): float | int;
    public function getQuentity(): int;
}