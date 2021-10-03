<?php

use App\Services\InvoiceService; 


test("'InvoiceService' method works correctly", function () {
    
    $invoice = (new InvoiceService())->makeInvoice(["T-shirt", "Blouse", "Pants", "Shoes", "Jacket"]);
    expect($invoice)->toBe(

        "Subtotal: $" . 386.95 . "\n".
        "Shipping: $" . 110 . "\n".
        "VAT: $" . 54.173 . "\n".
        "Discounts:" . "\n".
        "\t 10% off shoes: -$" . 7.999 . "\n".
        "\t 50% off jacket: -$" . 99.995 . "\n".
        "\t $10 off shipping: -$" . 10 . "\n".
        "Total: $" . 433.129 . "\n"

    );
});