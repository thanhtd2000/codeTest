<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Schedule extends Model
{
    use HasFactory;
    protected $table = 'schedule';
    protected $primaryKey = 'id';
    protected $fillable = [
        'date',
        'film_id',
        'room_id',
        'created_at',
        'updated_at'
    ];
    public function film()
    {
        return $this->belongsTo(Film::class, 'film_id');
    }
    public function room()
    {
        return $this->belongsTo(Room::class, 'room_id');
    }
}
