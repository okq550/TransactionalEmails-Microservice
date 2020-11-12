<?php

namespace App\Http\Controllers;

// require '../vendor/autoload.php';
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Queue;
use App\Jobs\EmailJob;
use \Validator;

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
     * Register
     *
     * @param  reciepent object
     * @return Response
     */
    public function register(Request $request)
    {
        $data = $request->json()->all();
        $recipients = $data['reciepents'];
        foreach ($recipients as $recipient) {
            $first_name = $recipient['first_name'];
            $last_name = $recipient['last_name'];
            $email = $recipient['email'];
            $format = $recipient['format'];

            $validator = Validator::make([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'format' => $format,
            ], [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'format' => ['in:html,text']
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            Queue::push(new EmailJob(array('operation' => 'register', 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'format' => $format, 'priority' => 1)));
        }
        // Log::info(print_r($recipient, true));
        return response()->json(['success' => true]);
    }

    /**
     * Forget password
     *
     * @param  reciepent object
     * @return Response
     */
    public function forgetPassword(Request $request)
    {
        $data = $request->json()->all();
        $recipients = $data['reciepents'];
        foreach ($recipients as $recipient) {
            $first_name = $recipient['first_name'];
            $last_name = $recipient['last_name'];
            $email = $recipient['email'];
            $format = $recipient['format'];

            $validator = Validator::make([
                'first_name' => $first_name,
                'last_name' => $last_name,
                'email' => $email,
                'format' => $format,
            ], [
                'first_name' => ['required'],
                'last_name' => ['required'],
                'email' => ['required', 'email'],
                'format' => ['in:html,text']
            ]);

            if ($validator->fails()) {
                return response()->json(['error' => $validator->errors()->all()]);
            }

            Queue::push(new EmailJob(array('operation' => 'forgetPassword', 'first_name' => $first_name, 'last_name' => $last_name, 'email' => $email, 'format' => $format, 'priority' => 1)));
        }
        // Log::info(print_r($recipient, true));
        return response()->json(['success' => true]);
    }
}
