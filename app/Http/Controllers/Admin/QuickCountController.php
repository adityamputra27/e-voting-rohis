<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\QuickCount;

class QuickCountController extends Controller
{
    private $periode_aktif;
    public function __construct()
    {
        $this->periode_aktif = DB::table('periode')->where('status', 'active')->first();
    }
    public function index()
    {
        $data['periode'] = DB::table('periode')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.quick_count.index')->with($data);
    }
    public function getJumlahSuaraKandidatKetua()
    {   
        $kandidat = QuickCount::setKandidatQuery('ketua', $this->periode_aktif->nama);

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
        $kandidat = QuickCount::setKandidatQuery('ketua', $this->periode_aktif->nama);
        
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
    public function getJumlahSuaraKandidatKeputrian()
    {   
        $kandidat = QuickCount::setKandidatQuery('keputrian', $this->periode_aktif->nama);

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
                'message' => 'success get jumlah suara kandidat keputrian',
                'data' => $result
            ]);

        } else {
            return response()->json([
                'status' => true,
                'message' => 'success get jumlah suara kandidat keputrian',
                'data' => []
            ]);
        }
    }
}
