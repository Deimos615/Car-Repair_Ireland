<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Auth;
use Carbon\Carbon;
use App\Models\Purchase;

class DashboardController extends Controller
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
    public function index(Request $request)
    {
        $comingValue = $this->getCount();
        $tmpArray = array();
        $tmpArray = explode('+', $comingValue);
        $upcomingCount = $tmpArray[0];
        $upcomingRepair = $tmpArray[1];
        $upcomingBooking = $tmpArray[2];
        
        return view('dashboard',[
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
    
  
}
