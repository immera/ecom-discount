<?php
namespace Immera\EcomDiscount\Service\Validations;

use Immera\EcomDiscount\Service\Models\DiscountCouponUsage;

class AmountValidation extends BaseValidation
{
    public function validate(): bool
    {
        $amount = $this->discount->min_amount;
        if ($amount === NULL) {
            return true;
        }
        $cart_amount = $this->cart->getAmount();
        return ($cart_amount >= $amount);
    }
}