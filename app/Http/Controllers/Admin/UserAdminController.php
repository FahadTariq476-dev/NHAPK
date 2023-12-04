<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;

class UserAdminController extends Controller
{
    //
    public function index(Request $request)
    {
          
        if ($request->ajax()) {
            $data = User::where('nhapk_register',1)->latest()->get();
            $formattedData = [];
            foreach ($data as $item) {
                $formattedData[] = [
                    $item->id,
                    $item->name,
                    empty($item->firstname) ? 'NULL' : $item->firstname,
                    empty($item->lastname) ? 'NULL' : $item->lastname,
                    empty($item->hostel_name) ? 'NULL' : $item->hostel_name,
                    $item->email,
                    empty($item->date_of_birth) ? 'NULL' : $item->date_of_birth,
                    // $item->date_of_birth,
                    $item->phone_number,
                    $item->cnic_no,
                    empty($item->address) ? 'NULL' : $item->address,
                    empty($item->short_description) ? 'NULL' : $item->short_description,
                ];
            }
            return DataTables::of($formattedData)
                ->escapeColumns([]) // Specify the index of the action column that contains raw HTML
                ->make(true);
        }
        $formattedData =[]; 
        return view('admin.users.list-users',compact('formattedData')); 
    }
}
