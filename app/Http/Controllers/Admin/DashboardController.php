<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index(){
        try{
            $totalusers = User::all()->count();
            $totalRegisteredUsers = User::where('verified_account', 1)->count();
            $totalNhapkUsers = User::where('nhapk_register', 1)->count();
            $totalUnRegisteredUsers = $totalusers - $totalRegisteredUsers;
            $nhapkRegisteredUsers = User::where('nhapk_register', 1)->with(['city'])->latest()->take(5)->get();
            // dd($nhapkRegisteredUsers->toArray());
            return view('admin.index')->with([
                'totalusers' => $totalusers,
                'totalRegisteredUsers' => $totalRegisteredUsers,
                'totalUnRegisteredUsers' => $totalUnRegisteredUsers,
                'totalNhapkUsers' => $totalNhapkUsers,
                'nhapkRegisteredUsers' => $nhapkRegisteredUsers,
            ]);
        }
        catch(Exception $e){
            return redirect()->back()->with('error', 'Your Exception is: '.$e->getMessage());
        }
    }
    
}
