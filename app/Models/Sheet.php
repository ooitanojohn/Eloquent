<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;
    protected $fillable = ['id', 'column', 'row'];

    public function reservations()
    {
        return $this->hasMany(Reservation::class, 'sheet_id', 'id');
    }

    // クエリ
    // public function scopeScreenId($query, $screen_id)
    // {
    //     $query->where('screen_id', '=', $screen_id);
    // }
}
