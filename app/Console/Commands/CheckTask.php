<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class CheckTask extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'scheduler:check-task';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Performs a recurring task every 5 minutes';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        /* $url = config('app.url') . '/api/getData';
        //print $url;
        $response = Http::get($url);

        if ($response->successful()) {
            $this->info('API call successful: ' . $response->body());
        } else {
            $this->error('API call failed: ' . $response->status());
        } */

        \Log::info('Running the 5-minute task...');
    }
}
