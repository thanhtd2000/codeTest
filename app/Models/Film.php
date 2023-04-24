<?php

namespace App\Models;

use App\Models\Schedule;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Film extends Model
{
    use HasFactory;
    protected $table = 'film';
    protected $primaryKey = 'id';
    protected $fillable = [
        'name',
        'type',
        'image',
        'director',
        'actor',
        'year',
        'created_at',
        'updated_at'
    ];
    public function Schedule()
    {
        return $this->hasMany(Schedule::class, 'film_id');
    }
}
