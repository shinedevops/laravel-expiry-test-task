<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\AcceptedRequest;
use Illuminate\Support\Facades\{Auth , Crypt};
use Carbon\Carbon;
class CheckUserToken
{
    /*
    Developer:      ShineDezign
    Created Date:   2021-07-08 (yyyy-mm-dd)
    Purpose:        Logout frontend-user if its session token is expired
    */
    public function handle(Request $request, Closure $next){
        if( Auth::user()->hasRole("frontend") ){
            if( !session('login_token_id') ){
                return redirect()->route('logout');
            }
            $accept_request = AcceptedRequest::find( Crypt::decryptString(session('login_token_id')) );
            $passed_seconds = $accept_request->link_opened_at->diffInSeconds( Carbon::now() ); 
            $valid_for_seconds = Carbon::createFromFormat("H:i:s",$accept_request->valid_for)->secondsSinceMidnight();
            //echo "$passed_seconds > $valid_for_seconds";
            if( $passed_seconds > $valid_for_seconds ){
                return redirect()->route('logout');
            }
            $pending_seconds = $valid_for_seconds - $passed_seconds;
            $request->merge(compact('pending_seconds'));
        }
        return $next($request);
    }
}
