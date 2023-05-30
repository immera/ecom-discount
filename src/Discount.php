<?php
namespace Immera\EcomDiscount;

use Exception;
use Illuminate\Support\Facades\Log;
use Immera\EcomDiscount\Service\Validations\UsageValidation;
use Immera\EcomDiscount\Service\Contracts\DiscountableCart;
use Immera\EcomDiscount\Service\Contracts\DiscountableOrder;
use Immera\EcomDiscount\Service\Contracts\DiscounteeUser;
use Immera\EcomDiscount\Service\Models\DiscountCoupon;
use Immera\EcomDiscount\Service\Models\DiscountCouponUsage;

class Discount {

    public function check(string $code, DiscountableCart $cart, DiscounteeUser $user): bool
    {
        $validations = [
            UsageValidation::class,            
        ];

        $coupon = DiscountCoupon::where('code', $code)->first();
        if (empty($coupon)) {
            Log::info('Discount Coupon not available for '. $code);
            return false;
        }

        return collect($validations)->reduce(function($result, $cls) use ($coupon, $cart, $user) {
            return $result && (new $cls($coupon, $cart, $user))->validate();
        }, true);
    }

    public function consume(string $code, DiscountableOrder $order, DiscounteeUser $user): bool
    {
        if (!$this->check($code, $order, $user)) {
            throw (new Exception('Coupon could not apply'));
        }

        // Update coupon usage in database
        $discount = DiscountCoupon::where('code', $code)->first();
        $order_total = $order->getAmount();
        DiscountCouponUsage::create([
            "discountee_id" => $user->id,
            "discountable_id" => $order->id,
            "discount_id" => $discount->id,
            "order_total" => $order_total,
            "discount_avail" => $discount->calc($order_total),
        ]);

        return true;
    }

}