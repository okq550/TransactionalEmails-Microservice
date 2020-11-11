<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
// use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use App\Models\Channel;
use \Mailjet\Resources;
use Mailgun\Mailgun;
use SendGrid\SendGrid;

class EmailJob implements ShouldQueue
{
    use InteractsWithQueue, Queueable, SerializesModels;

    protected $data;

    /**
     * Create a new job instance.
     *
    //  * @param  Podcast  $podcast
     * @return void
     */
    public function __construct($data)
    {
        $this->data = $data;
        // Log::info('Hello! Constructor Queue job is run at start time - ' . microtime(true));
        // Log::info(print_r($this->data['priority'], true));
    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function handle()
    {
        // Process sending emails
        Log::info('Queue job is run at start time - ' . microtime(true) . ', for operation: ' . $this->data['operation'] . ', for priority: ' . $this->data['priority']);
        Log::info(print_r($this->data, true));

        $channel = Channel::where('priority', '=', $this->data['priority'])->get()->first();
        Log::info('Checking if there is a channel with priority: ' . $this->data['priority'] . ', format: ' . $this->data['format']);
        if($channel){
            if($channel->count() > 0) {
                #Send the email using the channel if isActive is true.
                Log::info('Sending the email using channel with priority: ' . $this->data['priority'] . ', Channel name is: ' . $channel->name);
                if(!$channel->isActive){
                    Log::info('Current Channel name is: ' . $channel->name . ' is inactive, Will try the next one.');
                    Queue::push(new EmailJob(array('operation' => $this->data['operation'], 'first_name' => $this->data['first_name'], 'last_name' => $this->data['last_name'], 'email' => $this->data['email'], 'format' => $this->data['format'], 'priority' => $this->data['priority'] + 1)));
                    return;
                }
                $result = $this->sendEmail($channel->name);
                if($result != 200){
                    Queue::push(new EmailJob(array('operation' => $this->data['operation'], 'first_name' => $this->data['first_name'], 'last_name' => $this->data['last_name'], 'email' => $this->data['email'], 'format' => $this->data['format'], 'priority' => $this->data['priority'] + 1)));
                    return;
                }
                else{
                    Log::info('Email has been sent successfully');
                    return;
                }
            }
            else{
                #Do nothing.
                Log::info('No channel with priority: ' . $this->data['priority']);
                return;
            }
        }
        else{
            Log::info('No channel with priority: ' . $this->data['priority']);
            return;
        }

    }

    /**
     * Execute the job.
     *
     * @param  AudioProcessor  $processor
     * @return void
     */
    public function sendEmail($channelName)
    {
        Log::info('Called sendEmail for channel ' . $channelName . ', priority: ' . $this->data['priority']);
        Log::info(print_r($channelName, true));
        $result = $this->$channelName();
        Log::info(print_r($result, true));
        return $result;
    }

    public function MailJet(){
        $mj = new \Mailjet\Client('bcd9f7fc8e210e553828211625fc9941','d52baa43340a2453b92c6e8ba832ffad',true,['version' => 'v3.1']);
        $body = [
            'Messages' => [
            [
                'From' => [
                'Email' => "okq550@gmail.com",
                'Name' => "Osamah"
                ],
                'To' => [
                [
                    'Email' => "okq550@gmail.com",
                    'Name' => "Osamah"
                ]
                ],
                'Subject' => "Greetings from Mailjet.",
                'TextPart' => "My first Mailjet email",
                'HTMLPart' => "<h3>Dear passenger 1, welcome to <a href='https://www.mailjet.com/'>Mailjet</a>!</h3><br />May the delivery force be with you!",
                'CustomID' => "AppGettingStartedTest"
            ]
            ]
        ];
        $response = $mj->post(Resources::$Email, ['body' => $body]);
        $response->success() && var_dump($response->getData());
        $result = '400';
        if($response->success()){
            $result = 200;
        }
        return $result;
    }

    public function MailGun(){
        // # Instantiate the client.
        // $mgClient = Mailgun::create('ce69d280089753ab230522f02db55826-ba042922-8fc2715f', 'https://api.hello.com');
        // $domain = "sandbox988d7994b020402185364fac5cc53ce7.mailgun.org";
        // $params = array(
        //     'from'    => 'Mailgun Sandbox <postmaster@sandbox988d7994b020402185364fac5cc53ce7.mailgun.org>',
        //     'to'      => $data['first_name'] . ' ' . $data['last_name'] . '<' . $data['email'] . '>',
        //     'subject' => 'Hello',
        //     'text'    => 'Testing some Mailgun awesomness!',
        //     'html'    => '<html>HTML version of the body</html>'
        // );
        // # Make the call to the client.
        // $result = $mgClient->messages()->send($domain, $params);
        $result = '';
        // $result = 200;
        $result = 400;
        return $result;
    }

    public function SendGrid(){
        // # Instantiate the client.
        // $mgClient = Mailgun::create('ce69d280089753ab230522f02db55826-ba042922-8fc2715f', 'https://api.hello.com');
        // $domain = "sandbox988d7994b020402185364fac5cc53ce7.mailgun.org";
        // $params = array(
        //     'from'    => 'Mailgun Sandbox <postmaster@sandbox988d7994b020402185364fac5cc53ce7.mailgun.org>',
        //     'to'      => $data['first_name'] . ' ' . $data['last_name'] . '<' . $data['email'] . '>',
        //     'subject' => 'Hello',
        //     'text'    => 'Testing some Mailgun awesomness!',
        //     'html'    => '<html>HTML version of the body</html>'
        // );
        // # Make the call to the client.
        // $result = $mgClient->messages()->send($domain, $params);
        $result = '';
        // $result = 200;
        $result = 400;
        return $result;
    }
}