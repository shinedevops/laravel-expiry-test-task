<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LoginRequest extends Model
{
    use HasFactory;
    protected $fillable = ['user_id','status'];
    protected $appends = ['status_label'];
    
    /** Request sent by user **/
    public function sent_by(){
        return $this->belongsTo(User::class,'user_id');
    }

    /** Accepted request info **/
    public function accepted_request(){
        return $this->hasOne(AcceptedRequest::class,'request_id');
    }

    /** Status label **/
    public function getStatusLabelAttribute(){
        $button_class = "btn-info";
        $status = $this->status;
        if( $status == "accepted" )
            $button_class = "btn-success";
        elseif( $status == "rejected" )
            $button_class = "btn-danger";
        return "<button type='button' class='btn $button_class btn-sm text-capitalize'>{$this->status}</button>";
    }
}
