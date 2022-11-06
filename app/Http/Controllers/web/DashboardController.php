<?php

namespace App\Http\Controllers\web;

use App\Http\Controllers\Controller;
use App\Models\Hotel;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    /**
     * Display a statstics on dashboard.
     *
     * @return Application|Factory|View single Property
     */
    public function index()
    {
        return view('index');
    }
}
