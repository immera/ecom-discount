<?php
namespace Immera\EcomDiscount\Service\Models;

use Illuminate\Database\Eloquent\Model;
use Immera\EcomDiscount\Service\Enums\DiscountType;

class DiscountCoupon extends Model
{

    public function calc(int $total): float
    {
        switch ($this->discount_type) {
            case DiscountType::PERCENT:
                return floatval($total*$this->discount_value/100);
                break;

            case DiscountType::AMOUNT:
                return min($this->discount_value, $total);
                break;
                
            default:
                return 0;
                break;
        };
    }

}