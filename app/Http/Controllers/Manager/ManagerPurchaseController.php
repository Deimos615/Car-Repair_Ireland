<?php

namespace App\Http\Controllers\Manager;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class ManagerPurchaseController extends Controller
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
        $location = auth()->user()->location;
        $auth_garage_id = auth()->user()->id;
        $gname = auth()->user()->name;

        $pDates = DB::table('purchases')->select('date')->where('garage',$gname)->get();
        $pastCount = 0;
        $upcomingCount = 0;
        foreach ($pDates as $pDate) {  
            if( date('Y-m-d', strtotime($pDate->date)) <= now()) {
                $pastCount++;
            } else {
                $upcomingCount++;
            }
        }

        $date = now();
        $date->subDays(7);

        // Getting upcoming quotes
        $up_quotes = DB::select('select tbl.*,us.approved_date,us.id user_idp, rn.make, rn.model, rn.version, rn.engine_cc, rn.year_of_manufacture, qr.quote_id, qr.price, qr.garage_id, qr.picked_date, qr.reply, qr.deposit  
            from users us 
            left join(
                select r.*, group_concat(s.detail separator ", ") detail from repairs r 
                left join quotes q on q.repair_id=r.id
                left join services s on s.id=q.service_id
                where r.created_at>=?
                group by r.id
            ) tbl on us.location=tbl.sel_location and us.approved_date <= tbl.created_at
            left join quote_replies qr on qr.quote_id=tbl.id
            left join regnumbers rn on rn.reg=tbl.reg_number
            where qr.deposit is null and us.id=? 
            order by tbl.id desc', [$date, $auth_garage_id]);
        $upcomingRepair1 = count($up_quotes);

        $data = array();
        $last_qid = 0;
        $allEmpty = array();
        $authReply = array();
        $otherReply = array();
        foreach ($up_quotes as $key => $value) {
            $gid = $value->garage_id;
            $qid = $value->quote_id;
            if($key == 0) {
                $last_qid = $value->id;
            }
            else if($value->id != $last_qid) {
                if(!empty($authReply)) {
                    $data[$last_qid] = $authReply;
                } else if(!empty($otherReply)) {
                    $data[$last_qid] = $otherReply;
                } else {
                    $data[$last_qid] = $allEmpty;
                }
                $last_qid = $value->id;
                $allEmpty = array();
                $authReply = array();
                $otherReply = array();
            }
            if (empty($gid)) {
                $allEmpty = $value;
            } else if($gid == $auth_garage_id) {
                $authReply = $value;
            } else {
                $otherReply = $value;
            }
        }
        
        if(!empty($authReply)) {
            $data[$last_qid] = $authReply;
        } else if(!empty($otherReply)) {
            $data[$last_qid] = $otherReply;
        } else {
            $data[$last_qid] = $allEmpty;
        }
        $up_quotes = $data;
        
        $ret = array();
        foreach($data as $key => $value) {
            array_push($ret, $value);
        }
        $up_quotes = $ret;
        $upcomingRepair2 = count($up_quotes);
        if($upcomingRepair1 == 0) {
            $upcomingRepair = $upcomingRepair1;
        } else if($upcomingRepair2 == 1 && $up_quotes[0]->id == null) {
            $upcomingRepair = 0;
        } else {
            $upcomingRepair = $upcomingRepair2;
        }

        // Getting upcoming bookings
        $up_bookings = DB::select('select tbl.*,us.approved_date,us.id user_idp, rn.make, rn.model, rn.version, rn.engine_cc, rn.year_of_manufacture, qr.quote_id, qr.price, qr.garage_id, qr.picked_date, qr.reply, qr.deposit  
            from users us 
            left join(
                select r.*, group_concat(s.detail separator ", ") detail from repairs r 
                left join quotes q on q.repair_id=r.id
                left join services s on s.id=q.service_id
                where r.created_at>=?
                group by r.id
            ) tbl on us.location=tbl.sel_location and us.approved_date <= tbl.created_at
            left join quote_replies qr on qr.quote_id=tbl.id and qr.garage_id = ?
            left join regnumbers rn on rn.reg=tbl.reg_number
            where qr.deposit is not null and us.id=? 
            order by tbl.id desc', [$date, $auth_garage_id, $auth_garage_id]);
        $upcomingBooking1 = count($up_bookings);

        $data = array();
        $last_qid = 0;
        $allEmpty = array();
        $authReply = array();
        $otherReply = array();
        foreach ($up_bookings as $key => $value) {
            $gid = $value->garage_id;
            $qid = $value->quote_id;
            if($key == 0) {
                $last_qid = $value->id;
            }
            else if($value->id != $last_qid) {
                if(!empty($authReply)) {
                    $data[$last_qid] = $authReply;
                } else if(!empty($otherReply)) {
                    $data[$last_qid] = $otherReply;
                } else {
                    $data[$last_qid] = $allEmpty;
                }
                $last_qid = $value->id;
                $allEmpty = array();
                $authReply = array();
                $otherReply = array();
            }
            if (empty($gid)) {
                $allEmpty = $value;
            } else if($gid == $auth_garage_id) {
                $authReply = $value;
            } else {
                $otherReply = $value;
            }
        }
        
        if(!empty($authReply)) {
            $data[$last_qid] = $authReply;
        } else if(!empty($otherReply)) {
            $data[$last_qid] = $otherReply;
        } else {
            $data[$last_qid] = $allEmpty;
        }
        $up_bookings = $data;
        
        $ret = array();
        foreach($data as $key => $value) {
            array_push($ret, $value);
        }
        $up_bookings = $ret;
        $upcomingBooking2 = count($up_bookings);
        if($upcomingBooking1 == 0) {
            $upcomingBooking = $upcomingBooking1;
        } else {
            $upcomingBooking = $upcomingBooking2;
        }

        $gname = auth()->user()->name;
        $services = DB::table('purchases')->where('garage',$gname)->get();
        return view('manager.managerPurchase',[
            'services'=>$services,
            'upcomingCount'=> $upcomingCount,
            'upcomingRepair'=> $upcomingRepair,
            'upcomingBooking' => $upcomingBooking
        ]);
    }
}
