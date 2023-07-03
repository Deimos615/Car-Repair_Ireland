<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Transport;    
use Session;
use Stripe;
use Auth;
use Mail;

class TransportController extends Controller
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
        $costper = DB::table('costs')->select('costper')->get()->first();
        $mincost = DB::table('costs')->select('mincost')->get()->first();
        return view('transport',[
            'costpers'=> $costper,
            'mincosts'=> $mincost
        ]);
    }
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
                'reg_number' => 'required',
                'username' => 'required',
                'useremail' => 'required|email',
                'phone_number' => 'required|min:10',
                'date' => 'required',
                'pickup_location' => 'required',
                'destination_location' => 'required',
                'distance_value' => 'required',
                'duration_value' => 'required',
                'estimation_value' => 'required',
                'cost_value' => 'required',
                'loading_purpose' => 'required',
                'note' => 'required',
            ],
            [
                'reg_number.required' => 'Please input the registration number!',
                'username.required' => 'Please input the name!',
                'useremail.required' => 'Please input the email address!',
                'useremail.email' => 'Please input the email address exactly!',
                'phone_number.required' => 'Please input the phone number!',
                'phone_number.min' => 'Please input the phone number exactly!',
                'date.required' => 'Please input the date!',
                'pickup_location.required' => 'Please input the pickup location!',
                'destination_location.required' => 'Please input the destination location exactly!',
                'distance_value.required' => 'Empty distance value!',
                'duration_value.required' => 'Empty the duration value!',
                'estimation_value.required' => 'Empty the estimation value!',
                'cost_value.required' => 'Empty the level of inspection!',
                'loading_purpose.required' => 'Please input the loading purpose!',           
                'note.required' => 'Please input your note!',     
            ]
        );
  
        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()->all()
                    ]);
        }

        $result = Transport::create([
            'reg_number' => $request->reg_number,
            'name' => $request->username,
            'email' => $request->useremail,
            'phone_number' => $request->phone_number,
            'date' => $request->date,
            'pickup_location' => $request->pickup_location,
            'destination_location' => $request->destination_location,
            'distance' => $request->distance_value,
            'duration' => $request->duration_value,
            'estimation_value' => $request->estimation_value,
            'cost_value' => $request->cost_value,
            'loading_purpose' => $request->loading_purpose,
            'note' => $request->note,
        ]);

        $data = array(
            'name'=>$request->username,
            'email'=>$request->useremail,
            'phone_number'=>$request->phone_number,
            'pickup_location'=>$request->pickup_location,
            'destination_location'=>$request->destination_location,
            'reg_number'=>$request->reg_number,
            'date'=>$request->date,
            'distance_value'=>$request->distance_value,
            'duration_value'=>$request->duration_value,
            'estimation_value'=>$request->estimation_value,
            'cost_value'=>$request->cost_value,
            'loading_purpose'=>$request->loading_purpose,
            'note'=>$request->note,
        );

        Mail::send('transportMail', $data, function($message) {
            $message->to('autoguruireland@gmail.com', 'Autoguru Manager')
                    ->subject('Autoguru Transport Service Request');
            $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        });

        if(!$result) {
            return response()->json(array('status' => 1,'error' => "Database Error"));
        }  
        
        return response()->json(array('status' => 2,'msg' => "Successfully Submitted"));
  
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripe()
    {
        $user_email = auth()->user()->email;
        $esti_value = DB::table('transports')->where('email', $user_email)->select('estimation_value')->get()->last();
        $req_id = DB::table('transports')->where('email', $user_email)->select('id')->get()->last();
        return view('transportPayment',[
            'estiValues'=> $esti_value,
            'req_ids' => $req_id
        ]);
    }

    /**
     * success response method.
     *
     * @return \Illuminate\Http\Response
     */
    public function stripePost(Request $request)
    {
        Stripe\Stripe::setApiKey(env('STRIPE_SECRET'));
    
        Stripe\Charge::create ([
                "amount" => 100 * $request->amount,
                "currency" => "eur",
                "source" => $request->stripeToken,
                "description" => "Stripe Payment for the transport deposit" 
        ]);
      
        Session::flash('success', 'Payment successful to Autoguru!');

        $result = Quote_Reply::where('id', $request->req_id)
        ->update([
            'deposit' => $request->amount
        ]);

        if(!$result) {
            return response()->json(array('status' => 1,'error' => "Error ocurred"));
        }  
        
        // return redirect('transportConfirm');
              
        return back();
    }

}
