<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;

use App\Models\Channel;
use Exception;
use Illuminate\Console\Command;

/**
 * Class sendEmailCommand
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */
class EmailChannelCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "takeaway:list-channels";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "List email channel(s)";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $channels = Channel::all();
           
            if (!$channels) {
            $this->info("No channels exist in DB, Please run the seed command.");
                return;
            }
            foreach ($channels as $channel) {
                $this->info($channel->name . ' and its status is: ' . ($channel->isActive ? 'Active' : 'Inactive') );
            }
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}