<?php

use App\Models\Order;
use App\Models\User;

return [
    'models' => [
        'discountee' => User::class,
        'discountable' => Order::class,
    ],
];