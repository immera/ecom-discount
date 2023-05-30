<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Immera\EcomDiscount\Service\Models\DiscountCoupon;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_coupon_usages', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(config('discount.models.discountee'), 'discountee_id');
            $table->foreignIdFor(config('discount.models.discountable'), 'discountable_id');
            $table->foreignIdFor(DiscountCoupon::class, 'discount_id');
            $table->float('order_total');
            $table->float('discount_avail');
            $table->float('final_payable')->virtualAs("`order_total` - `discount_avail`");
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_coupon_usages');
    }
};