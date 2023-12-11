<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use Exception;
use Illuminate\Http\Request;

class DashboardClientController extends Controller
{
    //
    // Begin: Function to show the index.blade.php of client (Client Home Page)
    public function index(){
        try{
            return view('client.index');
        }
        catch(Exception $e){
            dd($e->getMessage());
        }
    }
    // End: Function to show the index.blade.php of client (Client Home Page)
    
}
