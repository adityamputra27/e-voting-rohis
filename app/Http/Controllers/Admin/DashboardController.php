<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    private $periode;
    public function __construct()
    {
        $this->periode = DB::table('periode')->where('status', 'active')->first();
    }
    public function dashboard() 
    {
        $data['pemilih'] = DB::table('pemilih')->count();
        $data['kandidat'] = DB::table('kandidat')->count();
        $data['sudahVoting'] = DB::table('pemilih')
                                ->where('status_id', '2')
                                ->where('periode_id', $this->periode->id)
                                ->count();
        $data['belumVoting'] = DB::table('pemilih')
                                ->where('status_id', '1')
                                ->where('periode_id', $this->periode->id)
                                ->count();

        return view('admins.index')->with($data);
    }
}
