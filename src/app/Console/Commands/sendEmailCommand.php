<?php
/**
 *
 * PHP version >= 7.0
 *
 * @category Console_Command
 * @package  App\Console\Commands
 */

namespace App\Console\Commands;

use Exception;
use Illuminate\Console\Command;
use \Validator;
use Illuminate\Support\Facades\Queue;
use App\Jobs\EmailJob;


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
            $operation = $this->ask('What operation type (register, forgetPassword)?');
            $first_name = $this->ask('What is your first name?');
            $last_name = $this->ask('What is your last name?');
            $email = $this->ask('What is your email?');
            $format = $this->ask('What email format (html, text)?');

            $validator = Validator::make([
                'operation' => $operation,
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'format' => $format,
            ], [
                'operation' => ['in:register,forgetPassword'],
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'format' => ['in:html,text']
            ]);

            if ($validator->fails()) {
                $this->info('Invalid inputs. See error messages below:');
                foreach ($validator->errors()->all() as $error) {
                    $this->error($error);
                }
                return 1;
            }
            Queue::push(new EmailJob(array('operation' => $operation, 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'format' => $format, 'priority' => 1)));
            $this->info("Your email request has been pushed");
        } catch (Exception $e) {
            $this->error($e->getMessage());
        }
    }
}