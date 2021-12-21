<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Problem extends Model
{
    use HasFactory;
    protected $fillable=['title', 'category_id','description','number','file_path','user_id','language_id'];

    public function user(){
        return $this->belongsTo('App\Models\User');
    }

    public function language(){
        return $this->belongsTo('App\Models\Language');
    }

    public function category(){
        return $this->belongsTo('App\Models\Category');
    }

    public function replies(){
        return $this->hasMany('App\Models\Reply');
    }

    
}
