<?php

namespace App\Http\Controllers\Client\sops;

use App\Http\Controllers\Controller;
use App\Models\Sop;
use Exception;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;


class SopsClientController extends Controller
{
    //
    // Begin: Function to show the list of sops to download
    public function list_sops(Request $request){
            // 
            // dd($request);
            if($request->ajax()){
                // 
                $data = Sop::latest()->get();
                // dd($data->toArray());
                return Datatables::of($data)
                    ->addIndexColumn()
                    ->make(true);
            }
        return view('client.sops.list-sops');
            
    }
    // End: Function to show the list of sops to download
}
