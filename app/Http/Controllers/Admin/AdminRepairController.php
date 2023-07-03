<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Repair;
use App\Models\Quote;
use App\Models\Quote_Reply;
use App\Models\Service;
use Carbon\Carbon;
use DataTables; 

class AdminRepairController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Repair::latest()->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->editColumn('created_at', function ($data) {
                        return $data->created_at ? with(new Carbon($data->created_at))->format('m/d/Y') : '';
                    })
                    ->addColumn('action', function($row){
   
                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-primary btn-sm editProduct"><i class="fa fa-eye"></i></a>';
   
                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct"><i class="fa fa-trash"></i></a>';
    
                            return $btn;
                    })
                    ->rawColumns(['action'])
                    ->make(true);
        }
      
        return view('admin.adminRepair');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Repair::updateOrCreate(['id' => $request->repair_id],
                [
                    'price' => $request->price, 
                    'reply' => $request->reply
                ]);        
   
        return response()->json(['success'=>'Repair request saved successfully.']);
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $service_id = Quote::latest()->where(['repair_id' => $id])->select('service_id')->get();
        $service_items = Service::latest()->whereIn('id', $service_id)->select('detail')->get();
        $response = DB::table('quote_replies')
        ->select('quote_replies.*', 'users.name', 'users.location')
            ->join('users', 'quote_replies.garage_id', '=', 'users.id')
            ->where('quote_replies.quote_id',$id)
            ->get();
        // dd($response);
        return response()->json(array('service_items'=>$service_items, 'response'=>$response));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Repair  $repair
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Repair::find($id)->delete();
     
        return response()->json(['success'=>'Repair request deleted successfully.']);
    }
}