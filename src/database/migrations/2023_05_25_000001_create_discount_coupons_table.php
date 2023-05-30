<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('discount_coupons', function (Blueprint $table) {
            $table->id();
            $table->string('code')->unique();
            $table->boolean('is_active')->default(false)->comment('define if the coupon is active or not.');
            $table->integer('min_quantity')->nullable()->comment('this defines minimum number of products to avail this coupon.');
            $table->integer('min_amount')->nullable()->comment('this defines minimum order amount to avail this coupon.');
            $table->integer('discount_type')->default(1)->comment('this define whether discount is in percentage or in amount in euro.');
            $table->integer('discount_value')->comment('this define how much discount will be applied for this coupon.');
            $table->integer('max_usage_per_user')->default(1)->comment('-1 = infinite, positive number will be number of usage.');
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
        Schema::dropIfExists('discount_coupons');
    }
};