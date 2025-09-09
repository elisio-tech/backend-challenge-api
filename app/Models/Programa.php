<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Programa extends Model
{
    protected $fillable = [
        'title',
        'start_date',
        'end_date',
        'status' // ativo ou inativo
    ];

    // Um programa pode ter varias candidaturas
    public function cadidaturas()
    {
        return $this->hasMany(Candidatura::class, 'program_id');
    }
}
