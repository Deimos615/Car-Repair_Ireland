<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Purchase;    
use App\Models\RegNumber;
use App\Models\User;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;
use Mail;

class PurchaseController extends Controller
{
    /**
     * Display a listing of the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$posts = Purchase::get();
        
        return view('purchase', compact('posts'));
    }
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'reg_number' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required|min:7',
                'garage' => 'required',
                'seller_phone' => 'required|min:7',
                'date' => 'required',
                'location' => 'required',
                'prefer_time' => 'required',
                'inspection' => 'required',
                'flexCheckDefault' => 'accepted',
            ],
            [
                'reg_number.required' => 'Please input the registration number!',
                'name.required' => 'Please input the name!',
                'email.required' => 'Please input the email address!',
                'email.email' => 'Please input the email address exactly!',
                'phone_number.required' => 'Please input the phone number!',
                'phone_number.min' => 'Please input the phone number exactly!',
                'garage.required' => 'Please input the garage name!',
                'seller_phone.required' => 'Please input the seller phone number!',
                'seller_phone.min' => 'Please input the seller phone number exactly!',
                'date.required' => 'Please input the date!',
                'location.required' => 'Please select the location!',
                'prefer_time.required' => 'Please select the preferred time!',
                'inspection.required' => 'Please select the level of inspection!',
                'flexCheckDefault.accepted' => 'Please check the Terms of use and privacy Policy!',           
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()
                    ]);
        }

        $result = Purchase::create([
            'reg_number' => $request->reg_number,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
            'garage' => $request->garage,
            'seller_phone' => $request->seller_phone,
            'date' => $request->date,
            'location' => $request->location,
            'prefer_time' => $request->prefer_time,
            'inspection' => $request->inspection,
        ]);

        $reg__number = RegNumber::where('reg', $request->reg_number)->first();
        if($reg__number == null) {
            $result_two = RegNumber::create([
                'reg' => $request->reg_number,
                'make' => $request->make,
                'model' => $request->model,
                'version' => $request->version,
                'body' => $request->body,
                'engine_cc' => $request->engine_cc,
                'year_of_manufacture' => $request->year_of_manufacture,
            ]);
        } else if($reg__number != null) {
            $result_two = RegNumber::where('reg', $request->reg)
                ->update([
                'reg' => $request->reg_number,
                'make' => $request->make,
                'model' => $request->model,
                'version' => $request->version,
                'body' => $request->body,
                'engine_cc' => $request->engine_cc,
                'year_of_manufacture' => $request->year_of_manufacture,
            ]);
        }  

        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'seller_phone'=>$request->seller_phone,
            'location'=>$request->location,
            'garage'=>$request->garage,
            'date'=>$request->date,
            'prefer_time'=>$request->prefer_time,
            'inspection'=>$request->inspection,
            'reg'=>$request->reg_number,
            'make'=>$request->make,
            'model'=>$request->model,
            'version'=>$request->version,
            'body'=>$request->body,
            'engine_cc'=>$request->engine_cc,
            'year_of_manufacture'=>$request->year_of_manufacture,
        );

        $garageEmails = User::select('email')->where('name', $request->garage)->get();
        $recipientEmails = $garageEmails->pluck('email')->push('autoguruireland@gmail.com')->push('pioneerdev1023@gmail.com')->toArray();

        Mail::send('purchaseMail', $data, function($message) use ($recipientEmails) {
            $message->to($recipientEmails)
                ->subject('Autoguru Pre-Purchase Inspection Service Request');
            $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        });

        // Mail::send('purchaseMail', $data, function($message) {
        //     $message->to('autoguruireland@gmail.com', 'Autoguru Manager')
        //             ->subject('Autoguru Pre-Purchase Inspection Service Request');
        //     $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        // });

        if(!$result && !$result_two) {
            return response()->json(array('status' => 1,'error' => "Database Error"));
        }
        
        return response()->json(array('status' => 2,'msg' => "Successfully Submitted"));

    }

    public function getRegDetail()
    {
        $user_email = auth()->user()->email;
        $regNumbers = DB::table('purchases')->select('reg_number')->where('email',$user_email)->get()->last();
        foreach ($regNumbers as $regNumber) {
            $regVehicle = DB::table('regnumbers')->where(['reg'=>$regNumber])->get();
        }

        return $regVehicle;
    }
}
