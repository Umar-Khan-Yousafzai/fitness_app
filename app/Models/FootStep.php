<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class FootStep extends Model
{
    protected $connection =  'mongodb';
    protected $fillable = [
        'user_id',
        'steps_count',
        'start_time',
        'end_time'
    ];
    use HasFactory;

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
