<?php
namespace Immera\EcomDiscount\Service\Validations;

use Immera\EcomDiscount\Service\Models\DiscountCouponUsage;

class IsActiveValidation extends BaseValidation
{
    public function validate(): bool
    {
        return (bool) $this->discount->is_active;
    }
}