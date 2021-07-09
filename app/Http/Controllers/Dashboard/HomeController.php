<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
class HomeController extends Controller
{
    /*
    Method Name:    index
    Developer:      Jasjit
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Dashboard page
    Params:
    */
    public function index(){

        return view("dashboard.welcome");
    }

    /*
    Method Name:    update_details
    Developer:      Jasjit
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Update user information from dashboard page
    Params:
    */
    public function update_details( Request $request ){
        $validated = $request->validate([
            'email' => 'required|email',
            'name'  => 'required'
        ]);
        Auth::user()->update( $request->all() );
        return back()->with('status','Profile updated successfully');
    }
}
