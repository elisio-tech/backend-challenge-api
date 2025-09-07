<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Candidatura extends Model
{
    protected $fillable = [
        'user_id',
        'program_id',
        'status', // pendente, aceite, rejeitado
    ];

    // Uma candidatura pertence a um usuário
    public function user()
    {
        return $this->belongsTo(User::class);
    }

     // Uma candidatura pertence a um programa
    public function programa()
    {
        return $this->belongsTo(Programa::class);
    }
}
