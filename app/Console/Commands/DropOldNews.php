<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;

class DropOldNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'news:kill-old-feed';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Killing old news.';

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
     * @return mixed
     */
    public function handle()
    {
        echo "started\n";
        echo "please wait\n";

        $limitDate = Carbon::now()
            ->subDays(env('DEAD_TIME'))
            ->toDateTimeString();

        DB::table('news')
            ->where('created_at', '<=', $limitDate)
            ->delete();

        echo "done✌\n";
    }
}
