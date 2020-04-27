<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        // 'product_id'=>1,
        'title'=>'product_test',
        'description'=>'description bla balh product test',
        'price_in_cents' => 100,
        'valid'=>1,
        'image'=>'url_picture_product_test.jpg',
        'stock'=>124,
        'origin_country'=>'FR',
        'category_id'=>1,
        'price_in_cents'=>1,
    ];
});
