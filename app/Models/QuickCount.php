<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use App\Services\Response;

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
    protected function getJumlahSuara($kategori, $periode)
    {
        $kandidat = self::setKandidatQuery($kategori, $periode);

        if (count($kandidat) > 0) {
            
            $result = [];

            foreach ($kandidat as $key => $value) {
                $result[] = [
                    'nama_siswa' => $value->nama_siswa,
                    'jumlah_suara' => $value->jumlah_suara,
                    'kelas' => $value->nama_kelas,
                    'periode' => $value->nama_periode
                ];
            }
            return Response::success($result, 'success get jumlah suara kandidat '.$kategori);
        } else {
            return Response::error('success get jumlah suara kandidat '.$kategori);

        }
    }
    protected function getPresentase($kategori, $periode)
    {
        $kandidat = self::setKandidatQuery($kategori, $periode);

        if (count($kandidat) > 0) {
            
            $result = [];
            if ($kategori == 'keputrian') {
                $countDataPemilih = DB::table('pemilih as pe')
                                        ->join('siswa as s', function($join) {
                                            $join->on('pe.siswa_id', '=', 's.id')
                                                 ->where('s.jenis_kelamin', '=', 'Perempuan')
                                                 ->where('pe.status_id', '=', '2')
                                                 ->orderBy('s.nama', 'ASC');
                                        })
                                        ->count();
            } else if ($kategori == 'ketua'){
                $countDataPemilih = DB::table('pemilih as pe')
                                        ->join('siswa as s', function ($join) {
                                            $join->on('pe.siswa_id', '=', 's.id')
                                                 ->whereIn('s.jenis_kelamin', ['Laki - laki', 'Perempuan'])
                                                 ->where('pe.status_id', '=', '2')
                                                 ->orderBy('s.nama', 'ASC');
                                        })
                                        ->count();
            }
            foreach ($kandidat as $key => $value) {
                $result[] = [
                    'nama_siswa' => $value->nama_siswa,
                    'jumlah_suara' => $value->jumlah_suara,
                    'kelas' => $value->nama_kelas,
                    'periode' => $value->nama_periode,
                    'presentase' => (int)($value->jumlah_suara / $countDataPemilih * 100)
                ];
            }
            return Response::success($result, 'success get presentase kandidat '.$kategori);
        } else {
            return Response::error('success get presentase kandidat '.$kategori);

        }
    }
}
