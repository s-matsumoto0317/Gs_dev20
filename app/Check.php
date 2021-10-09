<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Check extends Model
{
    //
    protected $fillable = [
        'posts_id',
        'check_item',
    ];
    
    // Postテーブルとの多対多リレーション
     public function post() {
        return $this->belongsTo('App\Post');
    }
}
