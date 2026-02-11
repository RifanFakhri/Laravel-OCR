<?php

namespace App\Services;

use App\Models\ParsingResult;

class ParsingResultService
{
    public static function store(array $parsedResult)
    {
        return ParsingResult::create([
            'nosert'        => $parsedResult['nosert'] ?? null,
            'noreg'         => $parsedResult['noreg'] ?? null,
            'nmkpl'         => $parsedResult['nmkpl'] ?? null,
            'jenis_sert'    => $parsedResult['jenis_sert'] ?? null,
            'jenis_survey'  => $parsedResult['jenis_survey'] ?? null,
            'divisi'        => $parsedResult['divisi'] ?? null,
            'lokasi_survey' => $parsedResult['lokasi_survey'] ?? null,
            'mem01'         => $parsedResult['mem01'] ?? null,
            'tgl_sert'      => $parsedResult['tgl_sert'] ?? null,
            'tgl_berlaku'   => $parsedResult['tgl_berlaku'] ?? null,
            'tgl_survey1'   => $parsedResult['tgl_survey1'] ?? null,
            'tgl_survey2'   => $parsedResult['tgl_survey2'] ?? null,
            'raw_result'    => $parsedResult,
        ]);
    }
}