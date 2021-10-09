<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //
    protected $fillable = [
        'post_desc',
    ];
    
    // Userテーブルとのリレーション （従テーブル側）
     public function user() {
     return $this->belongsTo('App\User');
    }
    
    // Userテーブルとの多対多リレーション
     public function favo_user() {
        return $this->belongsToMany('App\User');
    }
    
    // Checkテーブルとの多対多リレーション
     public function checks() {
     return $this->hasMany('App\Check', 'posts_id');
    }
    
}
