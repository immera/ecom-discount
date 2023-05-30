<?php
namespace Immera\EcomDiscount\Service\Models;

use Illuminate\Database\Eloquent\Model;

class DiscountCouponUsage extends Model
{
    protected $fillable = [
        "discountee_id",
        "discountable_id",
        "discount_id",
        "order_total",
        "discount_avail",
    ];
}