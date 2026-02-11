<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KonsepPermanen extends Model
{
    use HasFactory;

    protected $table = 'konsep_permanens';

    protected $fillable = [
        'nosert',
        'noreg',
        'nmkpl',
        'jenis_sert',
        'jenis_survey',
        'divisi',
        'lokasi_survey',
        'mem01',
        'tgl_sert',
        'tgl_berlaku',
        'tgl_survey1',
        'tgl_survey2',
        'raw_result',
    ];

    protected $casts = [
        'raw_result'        => 'array',
        'tgl_sert'          => 'date',
        'tgl_berlaku'       => 'date',
        'tgl_survey1'       => 'date',
        'tgl_survey2'       => 'date',
    ];

    public $timestamps = true;
}
