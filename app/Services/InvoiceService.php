<?php

namespace App\Services;

use App\Models\Item;



class InvoiceService{

    private static $discounts = 0;
    private static $shipping = 0;
    private static $subtotal = 0;
    private static $vat = 0;

    private static $invoice = "";


    
    /**
     * Take array(cart), give string(invoice).
     *
     * @return string
     */
    public function makeInvoice($cart) {

        $subtotal = self::$subtotal;
        $shipping = self::$shipping;
        $vat = self::$vat;
        $discounts = self::$discounts;

        $invoice = self::$invoice;


        
        foreach ($cart as $product) {

            try {
                
                $item = Item::where('type', $product)->firstOrFail();

            } catch (\Exception $exception) {
                
                $invoice .= "error: product '{$product}' is not existed in our catalog!\n";

                $invoice .= "Our Catalog: \n";

                foreach (Item::all() as $item) {
                    $invoice .= "\t {$item->type}\n";
                }

                return $invoice;
            }

            $subtotal += $item->price;
            $shipping += ((($item->weight) * 10) * $item->rate->rate);
            $vat += (($item->price) * 0.14);                      
        }


        $quantities = array_count_values($cart);


        /**
         * Shoes Offer.
         *
         * 
         */
        if ($quantities["Shoes"] ?? '' >= 1) {

            $offShoes = $quantities["Shoes"] * (79.99 * (10 / 100));
            $discounts += $offShoes;
            
        }


        /**
         * Two Tops and Jacket Offer.
         *
         * 
         */
        $numOfTops = (int)($quantities["T-shirt"] ?? '') + (int)($quantities["Blouse"] ?? '');

        if ($quantities["Jacket"] ?? '' >= 1 && $numOfTops >= 2) {

            $numOfDiscountableJackets = (int)($numOfTops / 2);

            $offJacket = 0;
            
            for ($x = 1; $x <= $numOfDiscountableJackets; $x++) {             
                $offJacket += (199.99 / 2);
            }
            
            $discounts += $offJacket;

        }


        /**
         * Shipping Offer.
         *
         * 
         */
        if (count($cart) >= 2) {

            $offShipping = 10;

            $discounts += $offShipping;

        }


        $total = ($subtotal + $shipping + $vat) - $discounts;


        ////
        ////
        $invoice .= "Subtotal: $" . $subtotal . "\n";
        $invoice .= "Shipping: $" . $shipping . "\n";
        $invoice .= "VAT: $" . $vat . "\n";


        if ($discounts > 0) {

            $invoice .= "Discounts:" . "\n";

            if (isset($offShoes)) {
                $invoice .= "\t 10% off shoes: -$" . $offShoes . "\n";
            }


            if (isset($offJacket)) {
                $invoice .= "\t 50% off jacket: -$" . $offJacket . "\n";
            }


            if (isset($offShipping)) {
                $invoice .= "\t $10 off shipping: -$" . $offShipping . "\n";
            }

        }

        $invoice .= "Total: $" . $total . "\n";

        return $invoice;
        ////
        ////
    }

}
