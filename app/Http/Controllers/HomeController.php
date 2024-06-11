<?php

namespace App\Http\Controllers;

use App\Models\Material;
use App\Models\Payment;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Auth;

class HomeController extends Controller
{
        /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        if (Auth::user()->hasRole('Super-Admin')) {
            $ttl_users  = User::role('User')->count();
            $ttl_materials   = Material::count();
        }
        else{
            $ttl_users  = '0';
            $ttl_materials   = Material::whereCreatedBy(auth()->id())->count();
        }

        return view('pages.dashboard',  [
            'ttl_users' => $ttl_users,
            'ttl_materials'  => $ttl_materials,
        ]);
    }
}
