<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    protected $fillable = [
        'user_id',
        'program_id',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function programa()
    {
        return $this->belongsTo(Programa::class, 'program_id');
    }
}
