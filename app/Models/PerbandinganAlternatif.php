<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PerbandinganAlternatif extends Model
{
    use HasFactory;

    protected $table = 'perbandingan_alternatif';

    protected $fillable = [
        'alternatif_one',
        'alternatif_two',
        'kriteria_id',
        'checked',
        'nilai'
    ];
}
