<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use App\Models\Quote_Reply;
use Illuminate\Http\Request;
use Stripe;
use Auth;
use Session;

class BookingController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $user_email = auth()->user()->email;

        $comingValue = $this->getCount();
        $tmpArray = array();
        $tmpArray = explode('+', $comingValue);
        $upcomingCount = $tmpArray[0];
        $upcomingRepair = $tmpArray[1];
        $upcomingBooking = $tmpArray[2];

        $date = now();
        $date->subDays(7);

        // $up_quotes = DB::table('repairs')
        // ->select('repairs.*', 'quotes.service_id', 'quote_replies.garage_id', 'quote_replies.price', 'quote_replies.reply', 'services.detail', DB::raw('GROUP_CONCAT(detail SEPARATOR ", ") as serviceIds'))
        //     ->leftjoin('quotes', 'repairs.id', '=', 'quotes.repair_id')
        //     ->leftjoin('services', 'services.id', '=', 'quotes.service_id')
        //     ->leftjoin('quote_replies', 'quote_replies.quote_id', '=', 'repairs.id')
        //     ->where('repairs.email',$user_email)
        //     ->whereDate('repairs.created_at','>=', $date)
        //     ->groupBy('repairs.id')
        //     ->get();
        
        $up_quotes = DB::select('select tbl.*, rn.make, rn.model, rn.version, rn.engine_cc, rn.year_of_manufacture, qr.id replied_id, qr.user_date, qr.deposit, qr.quote_id, qr.price, qr.garage_id, qr.picked_date, qr.reply, us.name gname  
            from (
                select r.*, group_concat(s.detail separator ", ") detail from repairs r 
                left join quotes q on q.repair_id=r.id
                left join services s on s.id=q.service_id
                where r.email=? and r.created_at>=?
                group by r.id
            ) tbl
            left join quote_replies qr on qr.quote_id=tbl.id
            left join users us on us.id=qr.garage_id
            left join regnumbers rn on rn.reg=tbl.reg_number
            where qr.deposit is not null
            order by tbl.id desc', [$user_email, $date]);
            
        // dd($up_quotes);
        $pre_quotes = DB::table('repairs')
        ->select('repairs.*', 'quotes.service_id', 'services.detail', DB::raw('GROUP_CONCAT(detail SEPARATOR ", ") as serviceIds'))
            ->join('quotes', 'repairs.id', '=', 'quotes.repair_id')
            ->join('services', 'services.id', '=', 'quotes.service_id')
            ->join('quote_replies', 'quote_replies.quote_id', '=', 'quotes.id')
            ->whereNotNull('quote_replies.deposit')
            ->where('repairs.email',$user_email)
            ->whereDate('repairs.created_at','<', $date)
            ->groupBy('repairs.id')
            ->get();
        return view('booking',[
            'up_quotes'=> $up_quotes,
            'pre_quotes' => $pre_quotes,
            'upcomingCount'=> $upcomingCount,
            'upcomingRepair'=> $upcomingRepair,
            'upcomingBooking' => $upcomingBooking
        ]);
    }

    public function getCount(){
        $user_id = auth()->user()->id;
        $user_email = auth()->user()->email;
        $username = auth()->user()->name;
        $pDates = DB::table('purchases')->select('date')->where('email',$user_email)->get();
        $pastCount = 0;
        $upcomingCount = 0;
        foreach ($pDates as $pDate) {  
            if( date('Y-m-d', strtotime($pDate->date)) <= now()) {
                $pastCount++;
            } else {
                $upcomingCount++;
            }
        }
        

        $pastRepair = 0;
        $upcomingRepair = 0;
        $subDate = now()->subDays(7);
        $rDates = DB::table('repairs')
                ->select('repairs.created_at')
                ->leftJoin('quote_replies', 'quote_replies.quote_id', '=', 'repairs.id')
                ->whereNull('quote_replies.deposit')
                ->where('email',$user_email)
                ->get();
        foreach ($rDates as $rDate) {
            if( date('Y-m-d H-i-s', strtotime($rDate->created_at)) <= $subDate) {
                $pastRepair++;
            } else {
                $upcomingRepair++;
            }
        }

        $pastBooking = 0;
        $upcomingBooking = 0;
        $subDate = now()->subDays(7);
        $bookDates = DB::table('repairs')
                ->select('repairs.created_at')
                ->join('quote_replies', 'quote_replies.quote_id', '=', 'repairs.id')
                ->whereNotNull('quote_replies.deposit')
                ->where('email',$user_email)
                ->get();
        foreach ($bookDates as $bookDate) {
            if( date('Y-m-d H-i-s', strtotime($bookDate->created_at)) <= $subDate) {
                $pastBooking++;
            } else {
                $upcomingBooking++;
            }
        }
        
        return $upcomingCount . "+" . $upcomingRepair . "+" . $upcomingBooking;
    }

    public function reply(Request $request) {
        $validator = Validator::make($request->all(), 
            [
                'replied_id' => 'required',
                'user_id' => 'required',
                'selected_date' => 'required'
            ],
            [
                'replied_id.required' => 'No garage replied!',
                'user_id.required' => 'No garage replied!',
                'selected_date.required' => 'Please input a date that you want to get our service!'
            ]
        );
 
        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()->all()
                    ]);
        }

        $result = Quote_Reply::where('id', $request->replied_id)
        ->update([
            'user_id' => $request->user_id,
            'user_date' => $request->selected_date,
        ]);

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
    // public function stripe()
    // {
    //     $user_email = auth()->user()->email;
    //     $esti_value = DB::table('transports')->where('email', $user_email)->select('estimation_value')->get()->last();
    //     $req_id = DB::table('transports')->where('email', $user_email)->select('id')->get()->last();
    //     return view('transportPayment',[
    //         'estiValues'=> $esti_value,
    //         'req_ids' => $req_id
    //     ]);
    // }

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
                "description" => "Stripe Deposit Payment for the Maintenance And Repair Service" 
        ]);
      
        Session::flash('success', 'Your deposit was successfully paid to Autoguru!');

        $result = Quote_Reply::where('id', $request->req_id)
        ->update([
            'deposit' => $request->amount
        ]);

        if(!$result) {
            return response()->json(array('status' => 1,'error' => "Error ocurred"));
        }  

        // return response()->json(array('status' => 2,'success' => "Successfully Paid!"));
        
        // return redirect('transportConfirm');
              
        return back();
    }
  
}
