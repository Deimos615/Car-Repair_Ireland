<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Sell;   
use App\Models\RegNumber; 
use Illuminate\Support\Facades\Http;
use Mail;

class SellController extends Controller
{
    /**
     * Display a listing of the index.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('/sell');
    }
     
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'name' => 'required',
                'useremail' => 'required|email',
                'phone_number' => 'required|min:7',
                'eircode' => 'required',
                'passenger_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'driver_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'front_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'rear_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'interior_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'odometer_img' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'reg_number' => 'required',
                'mileage' => 'required',
                'miles' => 'required',
                'timing' => 'required',
                'history' => 'required',
                'finance' => 'required',
                'car_issue' => 'required',
                'your_issue' => 'required',
                'flexCheckDefault' => 'accepted',
            ],
            [
                'reg_number.required' => 'Please input the registration number!',
                'name.required' => 'Please input your name!',
                'useremail.required' => 'Please input your email address!',
                'useremail.email' => 'Please input your email address exactly!',
                'phone_number.required' => 'Please input your phone number!',
                'phone_number.min' => 'Please input your phone number exactly!',
                'eircode.required' => 'Please input the eircode!',
                'mileage.required' => 'Please input the mileage!',
                'miles.required' => 'Please input the miles!',
                'timing.required' => 'Please timing belt!',
                'history.required' => 'Please input service history!',
                'finance.required' => 'Please input outstanding finance!',
                'car_issue.required' => 'Please enter car issue!',           
                'your_issue.required' => 'Please enter your note!',     
                'flexCheckDefault.accepted' => 'Please check the Terms of use and privacy Policy!', 
            ]
        );

        if ($validator->fails()) {
            return back()->withInput()->withErrors($validator->errors()->all());
        }

        $passenger_img = $request->passenger_img;        
        $driver_img = $request->driver_img;  
        $front_img = $request->front_img;  
        $rear_img = $request->rear_img;  
        $interior_img = $request->interior_img;  
        $odometer_img = $request->odometer_img;  

        $passenger_img_name = time().rand(1,99).'.'.$passenger_img->extension();  
        $passenger_img->move(public_path('upload'), $passenger_img_name);

        $driver_img_name = time().rand(1,99).'.'.$driver_img->extension();  
        $driver_img->move(public_path('upload'), $driver_img_name);

        $front_img_name = time().rand(1,99).'.'.$front_img->extension();  
        $front_img->move(public_path('upload'), $front_img_name);

        $rear_img_name = time().rand(1,99).'.'.$rear_img->extension();  
        $rear_img->move(public_path('upload'), $rear_img_name);

        $interior_img_name = time().rand(1,99).'.'.$interior_img->extension();  
        $interior_img->move(public_path('upload'), $interior_img_name);

        $odometer_img_name = time().rand(1,99).'.'.$odometer_img->extension();
        $odometer_img->move(public_path('upload'), $odometer_img_name);

        $result = Sell::create([
            'name' => $request->name,
            'email' => $request->useremail,
            'phone_number' => $request->phone_number,
            'eircode' => $request->eircode,
            'passenger_img' => $passenger_img_name,
            'driver_img' => $driver_img_name,
            'front_img' => $front_img_name,
            'rear_img' => $rear_img_name,
            'interior_img' => $interior_img_name,
            'odometer_img' => $odometer_img_name,
            'reg_number' => $request->reg_number,
            'mileage' => $request->mileage,
            'miles' => $request->miles,
            'timing' => $request->timing,
            'history' => $request->history,
            'finance' => $request->finance,
            'car_issue' => $request->car_issue,
            'your_issue' => $request->your_issue,
        ]);

        if (!$result) {
            return back()->withInput()->withErrors($validator->errors()->all());
        }

        // Checking Reg Number API
        $reg_number = $request->reg_number;
        $response = Http::get('http://api.motorcheck.ie/vehicle/reg/'.$reg_number.'/identity/vin?_username=auto-guru&_api_key=d512a3a4f87d26bc564e019f5ab05ba706aca6b7');
        $jsonData = $response->body();

        $xmlObject = simplexml_load_string($jsonData);
        $json = json_encode($xmlObject);
        $phpArray = json_decode($json, true); 
        
        if(isset($phpArray["errors"])){
            $reg = "The registration number provided could not be found in our Irish vehicle database!";
            $reg_data = array(
                'reg'=>$reg,
            );
        } else if(isset($phpArray["vehicle"])) {
            $reg = $phpArray["vehicle"]["reg"];
            $make = $phpArray["vehicle"]["make"];
            $model = $phpArray["vehicle"]["model"];
            $version = $phpArray["vehicle"]["version"];
            $body = $phpArray["vehicle"]["body"];
            $engine_cc = $phpArray["vehicle"]["engine_cc"];
            $year_of_manufacture = $phpArray["vehicle"]["year_of_manufacture"];
    
            $reg_data = array(
                'reg'=>$reg,
                'make'=>$make,
                'model'=>$model,
                'version'=>$version,
                'body'=>$body,
                'engine_cc'=>$engine_cc,
                'year_of_manufacture'=>$year_of_manufacture,
            );
    
            $reg__number = RegNumber::where('reg', $reg)->first();
            if($reg__number == null) {
                $result_two = RegNumber::create([
                    'reg' => $reg,
                    'make' => $make,
                    'model' => $model,
                    'version' => $version,
                    'body' => $body,
                    'engine_cc' => $engine_cc,
                    'year_of_manufacture' => $year_of_manufacture,
                ]);
            } else if($reg__number != null) {
                $result_two = RegNumber::where('reg', $reg)
                    ->update([
                    'reg' => $reg,
                    'make' => $make,
                    'model' => $model,
                    'version' => $version,
                    'body' => $body,
                    'engine_cc' => $engine_cc,
                    'year_of_manufacture' => $year_of_manufacture,
                ]);
            }
            if(!$result_two) {
                return back()->with('error','Error ocurred with reg number!');
            }
        }

        $data = array(
            'name'=>$request->name,
            'email'=>$request->useremail,
            'phone_number'=>$request->phone_number,
            'eircode'=>$request->eircode,
            'reg_number'=>$request->reg_number,
            'mileage'=>$request->mileage,
            'miles'=>$request->miles,
            'timing'=>$request->timing,
            'history'=>$request->history,
            'finance'=>$request->finance,
            'car_issue'=>$request->car_issue,
            'your_issue'=>$request->your_issue,
            'make'=>$make,
            'model'=>$model,
            'version'=>$version,
            'body'=>$body,
            'engine_cc'=>$engine_cc,
            'year_of_manufacture'=>$year_of_manufacture,
        );

        Mail::send('sellMail', $data, function($message) {
            $message->to('autoguruireland@gmail.com', 'Autoguru Manager')
                    ->subject('Autoguru Sell Service Request');
            $message->from('pioneerdev1023@gmail.com', 'Autoguru Client');
        });

        return back()->with('success', $reg_data);
    }
}
