<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function index()
    {
        $data=[];
        if(Auth::user()->role==1){
            $data['users'] = User::where('role',3)->count();
            $data['hotels'] = User::has('hotel')->where('role',2)->count();
        }
        else
        {

        }
        return view('dashboard',compact('data'));
    }
}
