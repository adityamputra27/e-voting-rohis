<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class QuickCount extends Model
{
    use HasFactory;

    protected function setKandidatQuery($kategori, $periode)
    {
        $data = DB::table('kandidat as ka')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as ke', 's.kelas_id', '=', 'ke.id')
                    ->join('periode as pe', 'ka.periode_id', '=', 'pe.id')
                    ->select('s.nama as nama_siswa', 'ka.jumlah_suara as jumlah_suara', 
                    'ke.nama as nama_kelas', 'pe.nama as nama_periode')
                    ->where('ka.kategori', $kategori)
                    ->where('pe.nama', $periode)
                    ->orderBy('nama_siswa')
                    ->get();
        if (!$data) {
            return [];
        }
        return $data;
    }
}
