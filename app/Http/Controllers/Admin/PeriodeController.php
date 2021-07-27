<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;

class PeriodeController extends Controller
{
    public function index()
    {
        $data['periode'] = DB::table('periode')->get();
        return view('admins.pages.periode.index')->with($data);
    }
    public function set_active(Request $request, $id)
    {
        $periode = DB::table('periode')->where('id', $id)->first();
        Session::put('periode', $periode);
        Session::flash('success', 'Periode '.$periode->nama.' Berhasil Di Aktifkan!');
        return redirect()->back();
    }
}
