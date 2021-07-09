<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AcceptedRequest extends Model
{
    use HasFactory;
    protected $fillable = ['request_id','valid_for','link_opened_at'];

    protected $casts = [
        'link_opened_at' => 'datetime:Y-m-d H:i:s',
    ];

    public function request(){
        return $this->belongsTo(LoginRequest::class);
    }
}
