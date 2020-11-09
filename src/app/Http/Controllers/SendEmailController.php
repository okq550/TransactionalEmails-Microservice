<?php

namespace App\Http\Controllers;

use App\User;
use Illuminate\Http\Request;

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
        // $data = $request->all();
        dd($data{'first_name'});
    }

    public function forget(Request $request)
    {
        $data = $request->json()->all();
        // $data = $request->all();
        dd($data{'first_name'});
    }
}
