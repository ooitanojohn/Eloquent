<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;

    // フィラブル || hidden
    protected $fillable = ['id','title','published_year','is_showing','description','image_url','updated_at','created_at'];
    // fillメソッド
    // 絞り込み

    // アソシエーション
    public function schedules(){
        return $this->hasMany(Schedule::class,'movie_id','id');
    }
}
