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
        return QuickCount::getJumlahSuara('ketua', $this->periode_aktif->nama);
    }
    public function getPresentaseKandidatKetua()
    {
        return QuickCount::getPresentase('ketua', $this->periode_aktif->nama);
    }
    public function getJumlahSuaraKandidatKeputrian()
    {   
        return QuickCount::getJumlahSuara('keputrian', $this->periode_aktif->nama);
    }
    public function getPresentaseKandidatKeputrian()
    {
        return QuickCount::getPresentase('keputrian', $this->periode_aktif->nama);
    }
}
