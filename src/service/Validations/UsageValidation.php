<?php
namespace Immera\EcomDiscount\Service\Validations;

use Immera\EcomDiscount\Service\Models\DiscountCouponUsage;

class UsageValidation extends BaseValidation
{
    public function validate(): bool
    {
        $usage = $this->discount->max_usage_per_user;
        if ($usage === -1) {
            return true;
        }
        if ($usage <= 0) {
            return false;
        }
        $count = DiscountCouponUsage::where('discountee_id', $this->user->getId())->count();
        return ($count < $usage);
    }
}