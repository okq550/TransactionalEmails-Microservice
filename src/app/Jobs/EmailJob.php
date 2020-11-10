<?php

namespace App\Jobs;

use Log;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class EmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    public $data;

    /**
     * Create a new job instance.
     *
    //  * @param  Podcast  $podcast
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        Log::info('Hello! Constructor Queue job is run at start time - '.microtime(true));
        Log::info(print_r($this->data, true));
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle()
    {
        // Process uploaded podcast...
        Log::info('Hello! Queue job is run at start time - '.microtime(true));
        Log::info(print_r($this->data, true));
    }
}