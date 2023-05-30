<?php

namespace Immera\EcomDiscount\Service\Enums;

enum DiscountType: int
{
    case PERCENT = 1;
    case AMOUNT = 2;
}