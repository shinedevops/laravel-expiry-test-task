<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\{User , LoginRequest , AcceptedRequest};
use Illuminate\Support\Facades\{Auth , Crypt};
use Carbon\Carbon;

class RequestController extends Controller
{
    /*
    Method Name:    request_form
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Form to send login request
    */

    public function request_form(){
        return view("frontend.request-form");
    }

    /*
    Method Name:    request_form
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Send login request to admin
    */    
    public function send_request(Request $request){
        $validated = $request->validate([
            'email' => 'exists:users'
        ]);
        $user = User::where('email',$request->email)->first();
        $login_requests = [
            'user_id'=> $user->id
        ];
        LoginRequest::create( $login_requests );
        return back()->with('status','Request sent successully.');
    }

    /*
    Method Name:    login_with_token
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Login from token
    */ 
    public function login_with_token( $token_id ){
        $accepted_request = AcceptedRequest::with('request.sent_by')->find( Crypt::decryptString($token_id) );
        if( $accepted_request->request && $accepted_request->request->sent_by ){
            if( !$accepted_request->link_opened_at ){
                $accepted_request->update([ 'link_opened_at' => Carbon::now()->format("Y-m-d H:i:s") ]);
                session([ 'login_token_id' => $token_id ]);
                Auth::login( $accepted_request->request->sent_by );
            }else{
                abort(404);
            }
        }
        return redirect('/');
    }
}
