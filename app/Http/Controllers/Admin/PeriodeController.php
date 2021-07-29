<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Session;
use App\Models\Periode;

class PeriodeController extends Controller
{
    public function index()
    {
        $data['periode'] = DB::table('periode')->get();
        return view('admins.pages.periode.index')->with($data);
    }
    public function apply(Request $request, $id)
    {
        $periode = Periode::where('id', $id)->firstOrFail();
        $status = ($periode->active == 'active') ? 'inactive' : 'active';

        Periode::where('status', 'active')->update(['status' => 'inactive']);
        Periode::where('id', $id)->update(['status' => $status]);

        Session::flash('success', 'Periode '.$periode->nama.' Berhasil Di Aktifkan!');
        return redirect()->back();
    }
}
