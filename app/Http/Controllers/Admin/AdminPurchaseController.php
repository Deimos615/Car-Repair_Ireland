<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Models\Purchase;
use Carbon\Carbon;
use DataTables;
use Hash;

class AdminPurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Purchase::latest()->get();
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
      
        return view('admin.adminPurchase');
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
                'location' => 'required|min:3|max:50',
                'name' => 'required|min:3|max:50',
                'email' => 'required|email',
                'password' => 'required|min:8',
                'confirm_password' => 'required|same:password' 
            ],
            [
                'location.required' => 'Please input the location!',
                'location.min' => 'Please input three characters at least',
                'name.required' => 'Please input the last name!',
                'email.required' => 'Please input the email address!',
                'email.email' => 'Please input the email address exactly!',
                'password.required' => 'Please input the password!',
                'password.min' => 'Please input eight characters at least!',
            ]
        );

        if ($validator->fails()) {
            return response()->json([
                        'status' => 0,
                        'error' => $validator->errors()->all()
                    ]);
        }

        $result = Purchase::updateOrCreate(['id' => $request->location_id],
                [
                    'location' => $request->location, 
                    'name' => $request->name,
                    'email' => $request->email,
                    'password' => Hash::make($request->password),
                    'type' => '2',
                ]);                
   
        // return response()->json(['success'=>'New garage saved successfully.']);
        return response()->json(array('status' => 1,'msg' => 'New garage saved successfully.'));
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $purchase = Purchase::find($id);
        return response()->json($purchase);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Location  $location
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Purchase::find($id)->delete();
     
        return response()->json(['success'=>'Garage deleted successfully.']);
    }
}