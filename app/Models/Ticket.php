<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        return $this->hasMany(Order::class, 'order_cinema_id');
    }
}
