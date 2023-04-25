<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ticket extends Model
{
    use HasFactory;
    protected $table = 'ticket';
    protected $primaryKey = 'id';
    protected $fillable = [
        'seat_name',
        'schedule_id',
        'order_cinema_id',
        'created_at',
        'updated_at'
    ];
    public function Order()
    {
        return $this->belongsTo(Order::class, 'order_cinema_id');
    }
    public function schedule()
    {
        return $this->belongsTo(Schedule::class, 'schedule_id');
    }
}
