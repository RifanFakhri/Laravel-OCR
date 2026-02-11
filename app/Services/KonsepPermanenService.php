<?php

namespace App\Services;

use App\Models\KonsepPermanen;

class KonsepPermanenService
{
    public static function store(array $data)
    {
        return KonsepPermanen::create([
            'nosert'        => $data['nosert'] ?? null,
            'noreg'         => $data['noreg'] ?? null,
            'nmkpl'         => $data['nmkpl'] ?? null,
            'jenis_sert'    => $data['jenis_sert'] ?? null,
            'jenis_survey'  => $data['jenis_survey'] ?? null,
            'divisi'        => $data['divisi'] ?? null,
            'lokasi_survey' => $data['lokasi_survey'] ?? null,
            'mem01'         => $data['mem01'] ?? null,
            'tgl_sert'      => $data['tgl_sert'] ?? null,
            'tgl_berlaku'   => $data['tgl_berlaku'] ?? null,
            'tgl_survey1'   => $data['tgl_survey1'] ?? null,
            'tgl_survey2'   => $data['tgl_survey2'] ?? null,
            'raw_result'    => $data,
        ]);
    }

    public static function getAll()
    {
        return KonsepPermanen::all();
    }

    public static function getById($id)
    {
        return KonsepPermanen::findOrFail($id);
    }

    public static function update($id, array $data)
    {
        $konsepPermanen = KonsepPermanen::findOrFail($id);
        $konsepPermanen->update($data);
        return $konsepPermanen;
    }

    public static function delete($id)
    {
        return KonsepPermanen::destroy($id);
    }
}
