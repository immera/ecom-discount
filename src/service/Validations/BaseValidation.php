<?php
namespace Immera\EcomDiscount\Service\Validations;

use Immera\EcomDiscount\Service\Contracts\DiscountableCart;
use Immera\EcomDiscount\Service\Contracts\DiscounteeUser;
use Immera\EcomDiscount\Service\Contracts\DiscountValidation;
use Immera\EcomDiscount\Service\Models\DiscountCoupon;

abstract class BaseValidation implements DiscountValidation
{
    protected DiscountCoupon $discount;
    protected DiscountableCart $cart;
    protected DiscounteeUser $user;

    public function __construct(
        DiscountCoupon $discount,
        DiscountableCart $cart,
        DiscounteeUser $user)
    {
        $this->discount = $discount;
        $this->cart = $cart;
        $this->user = $user;
    }

    abstract public function validate(): bool;
}