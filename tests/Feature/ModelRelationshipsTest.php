<?php

use App\Models\Item; 


test("'item has one (shipping) rate relationship' implemented correctly", function () {

    $rate = (Item::where("type", "T-shirt")->first())->rate->rate;
    expect((float)$rate)->toBe((float)2.0);

});