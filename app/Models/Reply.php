<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reply extends Model
{
    use HasFactory;
    protected $fillable=['message','file_path','confirmation_status','problem_id','user_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function problem(){
        return $this->belongsTo('App\Models\Problem');
    }

}
