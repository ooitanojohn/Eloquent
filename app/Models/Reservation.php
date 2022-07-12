<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;
    // フィラブル || hidden
    protected $fillable = ['id', 'date', 'schedule_id', 'sheet_id', 'email', 'name', 'created_at', 'updated_at'];
    // アソシエーション
    public function sheet()
    {
        return $this->belongsTo(Sheet::class);
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class);
    }
}
