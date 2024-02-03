<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorityVektorAlternatif extends Model
{
    use HasFactory;

    protected $table = 'priority_vektor_alternatif';

    protected $fillable = [
        'alternatif_id',
        'kriteria_id',
        'nilai'
    ];
}
