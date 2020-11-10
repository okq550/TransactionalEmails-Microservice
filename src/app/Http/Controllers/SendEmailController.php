<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;
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
        Queue::push(new EmailJob(array('operation' => 'register', 'first_name' => $data{'first_name'}, 'last_name' => $data{'last_name'}, 'email' => $data{'email'})));
		echo "successfully push register";
        dd($data{'first_name'});
    }

    public function forgetPassword(Request $request)
    {
        $data = $request->json()->all();
        Queue::push(new EmailJob(array('operation' => 'forgetPassword', 'email' => $data{'email'})));
		echo "successfully push forget.";
        dd($data{'first_name'});
    }
}
