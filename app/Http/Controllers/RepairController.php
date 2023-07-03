<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Repair;
use App\Models\Quote;
use App\Models\User;
use App\Models\RegNumber;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Http;

use Mail;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class RepairController extends Controller
{
    /**
     * Display a listing of the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	// $posts = Repair::get();
        // return view('repair', compact('posts'));
        // return view('repair');
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
                'sel_location' => 'required',
                'name' => 'required',
                'email' => 'required|email',
                'phone_number' => 'required|min:7',
                // 'array' => 'required|array|min:1',
                // 'detailArray' => 'required|array|min:1'     
            ],
            [
                'name.required' => 'Please input your name!',
                'email.required' => 'Please input your email address!',
                'email.email' => 'Please input your email address exactly!',
                'phone_number.required' => 'Please input your phone number!',
                'phone_number.min' => 'Please input your phone number exactly!',
                // 'array.required' => 'Please select one service item at least!',
                // 'detailArray.required' => 'Please select one service detail at least!'
            ]
        );
  
        if ($validator->fails()) {
            return response()->json([
                'status' => 0,
                'error' => $validator->errors()->all()
            ]);
        }
       
        $result_one = Repair::create([
            'reg_number' => $request->reg_number,
            'sel_location' => $request->sel_location,
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number,
        ]);

        $repair_id = $result_one->id;
        $service_id = $request->array;
        
        foreach ($service_id as $value) {
            $result_two = Quote::create([
                'repair_id' => $repair_id,
                'service_id' => $value,
            ]);
        }

        $reg__number = RegNumber::where('reg', $request->reg_number)->first();
        if($reg__number == null) {
            $result_three = RegNumber::create([
                'reg' => $request->reg_number,
                'make' => $request->make,
                'model' => $request->model,
                'version' => $request->version,
                'body' => $request->body,
                'doors' => $request->doors,
                'seats' => $request->seats,
                'reg_date' => $request->reg_date,
                'reg_date_ie' => $request->reg_date_ie,
                'sale_date' => $request->sale_date,
                'previous_reg' => $request->previous_reg,
                'engine_cc' => $request->engine_cc,
                'colour' => $request->colour,
                'fuel' => $request->fuel,
                'transmission' => $request->transmission,
                'year_of_manufacture' => $request->year_of_manufacture,
                'tax_class' => $request->tax_class,
                'tax_expiry_date' => $request->tax_expiry_date,
                'NCT_expiry_date' => $request->NCT_expiry_date,
                'nct_pass_date' => $request->nct_pass_date,
                'no_of_owners' => $request->no_of_owners,
                'chassis_no' => $request->chassis_no,
                'engine_no' => $request->engine_no,
                'co2_emissions' => $request->co2_emissions,
                'crwExpDate' => $request->crwExpDate,
                'vehicle_category' => $request->vehicle_category,
            ]);
        } else if($reg__number != null) {
            $result_three = RegNumber::where('reg', $request->reg_number)
                ->update([
                'reg' => $request->reg_number,
                'make' => $request->make,
                'model' => $request->model,
                'version' => $request->version,
                'body' => $request->body,
                'doors' => $request->doors,
                'seats' => $request->seats,
                'reg_date' => $request->reg_date,
                'reg_date_ie' => $request->reg_date_ie,
                'sale_date' => $request->sale_date,
                'previous_reg' => $request->previous_reg,
                'engine_cc' => $request->engine_cc,
                'colour' => $request->colour,
                'fuel' => $request->fuel,
                'transmission' => $request->transmission,
                'year_of_manufacture' => $request->year_of_manufacture,
                'tax_class' => $request->tax_class,
                'tax_expiry_date' => $request->tax_expiry_date,
                'NCT_expiry_date' => $request->NCT_expiry_date,
                'nct_pass_date' => $request->nct_pass_date,
                'no_of_owners' => $request->no_of_owners,
                'chassis_no' => $request->chassis_no,
                'engine_no' => $request->engine_no,
                'co2_emissions' => $request->co2_emissions,
                'crwExpDate' => $request->crwExpDate,
                'vehicle_category' => $request->vehicle_category,
            ]);
        }        

        $data = array(
            'name'=>$request->name,
            'email'=>$request->email,
            'phone_number'=>$request->phone_number,
            'detailArray'=>$request->detailArray,
            'reg'=>$request->reg,
            'make'=>$request->make,
            'model'=>$request->model,
            'version'=>$request->version,
            'body'=>$request->body,
            'doors'=>$request->doors,
            'seats'=>$request->seats,
            'reg_date'=>$request->reg_date,
            'sale_date'=>$request->sale_date,
            'previous_reg'=>$request->previous_reg,
            'engine_cc'=>$request->engine_cc,
            'colour'=>$request->colour,
            'fuel'=>$request->fuel,
            'transmission'=>$request->transmission,
            'year_of_manufacture'=>$request->year_of_manufacture,
            'tax_expiry_date'=>$request->tax_expiry_date,
            'NCT_expiry_date'=>$request->NCT_expiry_date,
            'nct_pass_date'=>$request->nct_pass_date,
            'no_of_owners'=>$request->no_of_owners,
            'chassis_no'=>$request->chassis_no,
            'engine_no'=>$request->engine_no,
            'co2_emissions'=>$request->co2_emissions,
            'crwExpDate'=>$request->crwExpDate,
            'vehicle_category'=>$request->vehicle_category,
        );

        // $emails = array("pioneerdev1023@gmail.com", "univan0928@gmail.com");
        // foreach($emails as $email) {
        //     Mail::send('repairMail', $data, function($message) {
        //         $message->to('pioneerdev1023@gmail.com', 'Autoguru Manager')
        //                 ->subject('Autoguru Quote Request');
        //         $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        //     });
        // }  

        $locationEmails = User::select('email')->where('location', $request->sel_location)->get();
        $recipientEmails = $locationEmails->pluck('email')->push('autoguruireland@gmail.com')->push('pioneerdev1023@gmail.com')->toArray();

        Mail::send('repairMail', $data, function($message) use ($recipientEmails) {
            $message->to($recipientEmails)
                ->subject('Autoguru Quote Request');
            $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        });

        if(!$result_one && !$result_two && !$result_three) {
            return response()->json(array('status' => 1,'error' => "Database Error"));
        }  
        
        return response()->json(array('status' => 2,'msg' => "Successfully Submitted"));
    }

    public function getCarDetailXML(Request $request, $num)
    {      
        $response = Http::get('http://api.motorcheck.ie/vehicle/reg/'.$num.'/identity/vin?_username=auto-guru&_api_key=d512a3a4f87d26bc564e019f5ab05ba706aca6b7');
        $jsonData = $response->body();
        return $jsonData;
    }
}
