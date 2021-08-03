<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class QuickCountController extends Controller
{
    public function index()
    {
        $data['periode'] = DB::table('periode')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.quick_count.index')->with($data);
    }
    private function queryKandidat($kategori)
    {
        $periode = DB::table('periode')->where('status', 'active')->first();

        $data = DB::table('kandidat as ka')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as ke', 's.kelas_id', '=', 'ke.id')
                    ->join('periode as pe', 'ka.periode_id', '=', 'pe.id')
                    ->select('s.nama as nama_siswa', 'ka.jumlah_suara as jumlah_suara', 
                    'ke.nama as nama_kelas', 'pe.nama as nama_periode')
                    ->where('ka.kategori', $kategori)
                    ->where('pe.nama', $periode->nama)
                    ->orderBy('nama_siswa')
                    ->get();

        
    }
    public function getJumlahSuaraKandidatKetua()
    {   
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

            return response()->json([
                'status' => true,
                'message' => 'success get jumlah suara kandidat ketua',
                'data' => $result
            ]);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'success get jumlah suara kandidat ketua',
                'data' => []
            ]);
        }
    }
    public function getPresentaseKandidatKetua()
    {
        $periode = DB::table('periode')->where('status', 'active')->first();

        $kandidat = DB::table('kandidat as ka')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as ke', 's.kelas_id', '=', 'ke.id')
                    ->join('periode as pe', 'ka.periode_id', '=', 'pe.id')
                    ->select('s.nama as nama_siswa','ke.nama as nama_kelas', 
                    'pe.nama as nama_periode', 'ka.jumlah_suara as jumlah_suara')
                    ->where('ka.kategori', 'ketua')
                    ->where('pe.nama', $periode->nama)
                    ->orderBy('nama_siswa')
                    ->get();
        
        if (count($kandidat) > 0) {
            
            $result = [];
            $countDataPemilih = DB::table('pemilih')->where('status_id', '2')->count();

            foreach ($kandidat as $key => $value) {
                $result[] = [
                    'nama_siswa' => $value->nama_siswa,
                    'jumlah_suara' => $value->jumlah_suara,
                    'kelas' => $value->nama_kelas,
                    'periode' => $value->nama_periode,
                    'presentase' => (int)($value->jumlah_suara / $countDataPemilih * 100)
                ];
            }

            return response()->json([
                'status' => true,
                'message' => 'success get presentase kandidat ketua',
                'data' => $result
            ]);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'success get presentase kandidat ketua',
                'data' => []
            ]);
        }
    }
}
