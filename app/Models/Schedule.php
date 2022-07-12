<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Schedule extends Model
{
    use HasFactory;
    // フィラブル || hidden
    protected $fillable = ['id', 'movie_id', 'screen_id', 'start_time', 'end_time', 'updated_at', 'created_at'];
    // アソシエーション
    public function movie()
    {
        return $this->belongsTo(Movie::class);
    }
    /**
     * dateのキャスト
     * carbonをviewでfunction呼び出し可能に
     * @var array
     */
    protected $casts = [
        'start_time' => 'date:Y-m-d H:i',
        'end_time' => 'date:Y-m-d H:i',
    ];
    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'schedule_id', 'id');
    }
}
