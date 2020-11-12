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
class SendEmailCommand extends Command
{
    /**
     * The console command name.
     *
     * @var string
     */
    protected $signature = "takeaway:send-email";

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = "Send email to recipient(s)";


    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        try {
            $posts = Post::getPosts();
           
            if (!$posts) {
            $this->info("No posts exist");
                return;
            }
            foreach ($posts as $post) {
                $post->delete();
            }
            $this->info("All posts have been deleted");
        } catch (Exception $e) {
            $this->error("An error occurred");
        }
    }
}