<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    //
    public function showAdminDashboard(){
        return view('admin.dashboard');
    }

    public function index(){
        return view('admin.index');
    }
    
}
