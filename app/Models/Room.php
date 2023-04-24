<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Room extends Model
{
    use HasFactory;
    protected $table = 'rooms';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'row',
        'seat_number',
        'created_at',
        'updated_at'
    ];
    public function Schedule()
    {
        return $this->hasMany(Schedule::class, 'room_id');
    }
}
