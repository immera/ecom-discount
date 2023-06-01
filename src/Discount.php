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
use Immera\EcomDiscount\Service\Validations\AmountValidation;
use Immera\EcomDiscount\Service\Validations\IsActiveValidation;
use Immera\EcomDiscount\Service\Validations\QuantityValidation;

class Discount {

    public function check(string $code, DiscountableCart $cart, DiscounteeUser $user): ?float
    {
        $validations = [
            IsActiveValidation::class,
            QuantityValidation::class,
            AmountValidation::class,
            UsageValidation::class,
        ];

        $discount = DiscountCoupon::where('code', $code)->first();
        if (empty($discount)) {
            Log::info('Discount Coupon not available for '. $code);
            return false;
        }

        $valid = collect($validations)->reduce(function($result, $cls) use ($discount, $cart, $user) {
            return $result && (new $cls($discount, $cart, $user))->validate();
        }, true);

        return $valid ? $discount->calc($cart->getAmount()): NULL;
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
            "discountee_id" => $user->getId(),
            "discountable_id" => $order->getId(),
            "discount_id" => $discount->id,
            "order_total" => $order_total,
            "discount_avail" => $discount->calc($order_total),
        ]);
        // Notify order that we used this token with this order, so app can maintain this from their end.
        $order->useDiscount($discount);
        return true;
    }

}