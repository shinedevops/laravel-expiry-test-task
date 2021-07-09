<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{LoginRequest , AcceptedRequest};
use App\Notifications\LoginRequest as LoginRequestNotification;
class ManageRequests extends Controller
{
    /*
    Method Name:    index
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Display listing to requests received
    */
    public function index(){
        $login_requests = LoginRequest::latest()->paginate(20);
        return view( "dashboard.received-requests" , compact('login_requests') );
    }

    /*
    Method Name:    accept_request
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Accept one of the login request
    */
    public function accept_request( Request $request ){
        $validated = $request->validate([
            'request_id' => 'required',
            'valid_for'    =>  'required'
        ]);
        $login_request = LoginRequest::find($request->request_id);
        if( $login_request->sent_by ){
            $login_request->update(['status'=>'accepted']);
            $accept_request = AcceptedRequest::create( $request->all() );
            $login_request->sent_by->notify(new LoginRequestNotification($accept_request));
        }
        return back()->with('status','Request accepted successully');
    }

    /*
    Method Name:    accept_request
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Decline one of the login request
    */
    public function decline_request( LoginRequest $request ){
        $request->update(['status'=>'rejected']);
        if( $request->sent_by ){
            $request->sent_by->notify(new LoginRequestNotification());
        }
        return back()->with('status','Request rejected successully');
    }
}
