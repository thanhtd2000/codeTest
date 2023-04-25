<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $table = 'order_cinema';
    protected $primaryKey = 'id';
    protected $fillable = [
        'price',
        'user_id',
        'created_at',
        'updated_at'
    ];

    public function Ticket()
    {
        return $this->hasMany(Ticket::class, 'order_cinema_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
