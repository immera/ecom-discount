<?php
namespace Immera\EcomDiscount\Service\Contracts;

use Immera\EcomDiscount\Service\Models\DiscountCoupon;

interface DiscountableOrder extends DiscountableCart {
    public function useDiscount(DiscountCoupon $coupon): void;
    public function getId(): int;
}