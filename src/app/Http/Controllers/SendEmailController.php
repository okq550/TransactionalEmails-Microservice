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
        Log::info(print_r($data, true));
        Queue::push(new EmailJob(array('operation' => 'register', 'first_name' => $data{'first_name'}, 'last_name' => $data{'last_name'}, 'email' => $data{'email'}, 'format' => $data{'format'}, 'priority' => 1)));
        return response()->json(['success' => true]);
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->json()->all();
        Log::info(print_r($data, true));
        Queue::push(new EmailJob(array('operation' => 'forgetPassword', 'first_name' => $data{'first_name'}, 'last_name' => $data{'last_name'}, 'email' => $data{'email'}, 'format' => $data{'format'}, 'priority' => 1)));
        return response()->json(['success' => true]);
    }
}
