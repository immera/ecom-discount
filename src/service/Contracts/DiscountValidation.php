<?php
namespace Immera\EcomDiscount\Service\Contracts;

interface DiscountValidation {
    public function validate(): bool;
}