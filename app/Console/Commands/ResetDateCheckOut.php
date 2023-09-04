<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\CheckInOut;

class ResetDateCheckOut extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:ResetDateCheckOut';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $items = CheckInOut::all();
        foreach($items as $item){
            if($item->end_time == null) {
                $item->end_time = date("Y-m-d H:i:s" ,strtotime("12:00 PM", time()));
                $item->reason_early = 'forgot checkout';
                $item->save();
            }
        }
        return 0;
    }
}
