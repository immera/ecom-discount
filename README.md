# Discount Package

This will be a simple discount module for e-commerce website. 

**Intro**  
In general, most e-commerce websites require a discount module to enhance their offerings. I have come up with a simple package that can be immensely helpful for implementing discounts. The core functionality of this module is to determine if a discount is applicable and subsequently apply it. Within this package, we have defined two methods: one for checking if a discount is applicable, and another for applying the discount.

To ensure the validity of the discount, we have included basic validations. These validations encompass several criteria, including:

* Checking if the discount is currently active.
* Verifying if the order meets the minimum quantity requirement to qualify for the discount.
* Confirming if the order satisfies the minimum amount threshold set for eligibility.
* Restricting the number of times a specific user can utilize the discount coupon.

By incorporating these validations, we can ensure that the discount is only applied when the specified conditions are met. This package provides a solid foundation for integrating a discount module into an e-commerce website, making the implementation process much smoother.

**Installation**
```
composer require immera/ecom-discount
```

**Usage**

once this is installed, you will have access to the `Immera\EcomDiscount\Discount` class, you can use it with laravel app resolver like 
```
$discount = app(Immera\EcomDiscount\Discount::class)
```
to instanciate the discount. and now this `$discount` will have two methods  
* `check(string $code, DiscountableCart $cart, DiscounteeUser $user)`
* `consume(string $code, DiscountableOrder $order, DiscounteeUser $user)`

here you need to understand some of the terminology to use this package.

**`string $code`** - This will be discount coupon code, using which we will be identified individual discount.

**`DiscountableCart $cart`** - This DiscountableCart will be an interface so you need to pass an object of the class that implements this interface.

DiscountableCart interface needs to have the following methods
* `getQuantity()` which should return number of items in the order
* `getAmount()` which return final total amount of the order.

**`DiscountableOrder $order`** This DiscountableOrder will also be an interface so you need to pass an object of the class that implements this interface.

DiscountableOrder interface needs all the methods of DiscountableCart and in addition to that it also needs to have the following methods
* `getId()` which return id of the order
* `useDiscount(DiscountCoupon $discount)` here you need to update your order to consider it's using this discount that passed in the argument, so this is basically enable you to perform some action once the discount has been used on particular order.