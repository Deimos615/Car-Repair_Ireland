<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport;    
use Session;
use Auth;
use Mail;

class ContactController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Display a listing of the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('contact');
    }
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                'username' => 'required',
                'useremail' => 'required|email',
                'loading_purpose' => 'required',
                'note' => 'required',
            ],
            [
                'username.required' => 'Please input the name!',
                'useremail.required' => 'Please input the email address!',
                'useremail.email' => 'Please input the email address exactly!',
                'loading_purpose.required' => 'Please input the contact purpose!',           
                'note.required' => 'Please input a detail!',     
            ]
        );
  
        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()->all()
                    ]);
        }

        $data = array(
            'name'=>$request->username,
            'email'=>$request->useremail,
            'loading_purpose'=>$request->loading_purpose,
            'note'=>$request->note,
        );

        Mail::send('contactMail', $data, function($message) {
            $message->to('autoguruireland@gmail.com', 'Autoguru Manager')
                    ->subject('Autoguru Contact Service Request');
            $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        });

        return response()->json(array('status' => 2,'msg' => "Successfully Submitted"));
  
    }

}
