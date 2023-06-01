<?php
namespace Immera\EcomDiscount\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Immera\EcomDiscount\Service\Enums\DiscountType;

class DiscountCoupon extends Model
{

    protected $casts = [
        'discount_type' => DiscountType::class
    ];

    public function calc(int $total): float
    {
        return match($this->discount_type) {
            DiscountType::PERCENT => floatval($total*$this->discount_value/100),
            DiscountType::AMOUNT => min($this->discount_value, $total),
            default => 0,
        };
    }

}