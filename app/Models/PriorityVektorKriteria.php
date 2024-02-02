<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityVektorKriteria extends Model
{
    use HasFactory;

    protected $table = 'priority_vektor_kriteria';

    protected $fillable = [
        'kriteria_id',
        'nilai'
    ];
}
