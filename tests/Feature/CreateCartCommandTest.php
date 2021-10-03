<?php

use App\Models\Item;

test('createCart command outputs invoice correctly', function () {

    $this
    ->artisan('createCart --product=T-shirt --product=Blouse --product=Pants --product=Shoes --product=Jacket')
    ->expectsOutput(
        
        

        "Subtotal: $" . 386.95 . "\n".
        "Shipping: $" . 110 . "\n".
        "VAT: $" . 54.173 . "\n".
        "Discounts:" . "\n".
        "\t 10% off shoes: -$" . 7.999 . "\n".
        "\t 50% off jacket: -$" . 99.995 . "\n".
        "\t $10 off shipping: -$" . 10 . "\n".
        "Total: $" . 433.129 . "\n"



    )
    ->assertExitCode(0);
});


test('createCart command exceptions are handled correctly', function () {

    $catalog = "";

    foreach (Item::all() as $item) {
        $catalog .= "\t {$item->type}\n";
    }


    $this
    ->artisan('createCart --product=T-shirt --product=Blazer')
    ->expectsOutput(
        
        

        "error: product 'Blazer' is not existed in our catalog!\n".
        "Our Catalog: \n".
        $catalog



    )
    ->assertExitCode(0);
});