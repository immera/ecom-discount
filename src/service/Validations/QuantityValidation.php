<?php
namespace Immera\EcomDiscount\Service\Validations;

use Immera\EcomDiscount\Service\Models\DiscountCouponUsage;

class QuantityValidation extends BaseValidation
{
    public function validate(): bool
    {
        $quantity = $this->discount->min_quantity;
        if ($quantity === NULL) {
            return true;
        }
        $cart_quantity = $this->cart->getQuantity();
        return ($cart_quantity >= $quantity);
    }
}