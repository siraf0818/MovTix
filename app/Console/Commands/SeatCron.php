<?php

namespace App\Console\Commands;

use App\Models\Order;
use App\Models\Payment;
use Carbon\Carbon;
use Illuminate\Console\Command;

class SeatCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'seat:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $expired = Carbon::now()->subMinutes(10);
        $id = Payment::pluck('order_id')->all();;
        Order::where([['created_at', '<=', $expired]])->whereNotIn('order_id', $id)->delete();
    }
}
