<?php

namespace App\Commands;

use Illuminate\Console\Scheduling\Schedule;
use LaravelZero\Framework\Commands\Command;

//
use App\Services\InvoiceService;
//

class CreateCartCommand extends Command
{
    /**
     * The signature of the command.
     *
     * @var string
     */
    protected $signature = 'createCart {--product=*}';

    /**
     * The description of the command.
     *
     * @var string
     */
    protected $description = 'Add product(s) to the cart and print invoice';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle(InvoiceService $invoiceService) {

        $cart = $this->option('product');
        $this->info($invoiceService->makeInvoice($cart));
        
    }

    /**
     * Define the command's schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule $schedule
     * @return void
     */
    public function schedule(Schedule $schedule): void
    {
        // $schedule->command(static::class)->everyMinute();
    }
}
