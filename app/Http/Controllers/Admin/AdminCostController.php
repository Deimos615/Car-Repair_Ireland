<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Cost;
use Illuminate\Support\Facades\DB;

class AdminCostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $costper = DB::table('costs')->where(['id'=>'1'])->value('costper');
        $mincost = DB::table('costs')->where(['id'=>'1'])->value('mincost');

        return view('admin.adminCost', ['costper'=>$costper, 'mincost'=>$mincost]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
                'cost' => 'required',
                'deposit_cost' => 'required'
            ],
            [
                'cost.required' => 'Please input the cost per km!',
                'deposit_cost.required' => 'Please input the minimun deposit cost!'
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()->all()
                    ]);
        }

        $result = Cost::where('id', $request->cost_id)->first()
        ->update([
            'costper' => $request->cost,
            'mincost' => $request->deposit_cost,
        ]);

        if(!$result) {
            return response()->json(array('status' => 1,'error' => "Database Error"));
        }  
        
        return response()->json(array('status' => 2,'msg' => "Successfully Submitted"));

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cost = Cost::find($id);
        return response()->json($cost);
    }

}