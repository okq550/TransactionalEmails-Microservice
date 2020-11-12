<?php

namespace App\Http\Controllers;

// require '../vendor/autoload.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use App\Jobs\EmailJob;

class SendEmailController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Retrieve the user for the given ID.
     *
     * @param  int  $id
     * @return Response
     */
    public function register(Request $request)
    {
        $data = $request->json()->all();
        $recipients = $data['reciepents'];
        foreach ($recipients as $recipient) {
            Queue::push(new EmailJob(array('operation' => 'register', 'first_name' => $recipient['first_name'], 'last_name' => $recipient['last_name'], 'email' => $recipient['email'], 'format' => $recipient['format'], 'priority' => 1)));
        }
        // Log::info(print_r($recipient, true));
        return response()->json(['success' => true]);
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->json()->all();
        $recipients = $data['reciepents'];
        foreach ($recipients as $recipient) {
            Queue::push(new EmailJob(array('operation' => 'forgetPassword', 'first_name' => $recipient['first_name'], 'last_name' => $recipient['last_name'], 'email' => $recipient['email'], 'format' => $recipient['format'], 'priority' => 1)));
        }
        // Log::info(print_r($recipient, true));
        return response()->json(['success' => true]);
    }
}
