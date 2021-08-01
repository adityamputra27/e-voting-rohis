<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Session;
use App\Models\Pemilih;

class PemilihController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['pemilih'] = DB::table('pemilih')
                            ->join('siswa', 'pemilih.siswa_id', '=', 'siswa.id')
                            ->join('periode', 'pemilih.periode_id', '=', 'periode.id')
                            ->join('status', 'pemilih.status_id', '=', 'status.id')
                            ->select('pemilih.*', 'siswa.nama as nama_siswa', 'siswa.nama_kelas as kelas', 'periode.nama as periode', 'status.nama as status')
                            ->get();
        return view('admins.pages.pemilih.index')->with($data);
        // dd($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['periode'] = DB::table('periode')->get();
        $data['siswa'] = DB::table('siswa')->orderBy('nama', 'ASC')->get(); 
        return view('admins.pages.pemilih.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $periode = DB::table('periode')->where('status', 'active')->first();

        $pemilih = new Pemilih;
        $pemilih->siswa_id = $request->siswa_id;
        $pemilih->periode_id = $request->periode_id ?? $periode->id;
        $pemilih->status_id = 1;
        
        // Bkin tokennya manual :v
        $karakter = 'ABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890';
        $string = '';
        for ($i = 0; $i < 6; $i++) { 
            $pos = rand(0, strlen($karakter) - 1);
            $string .= $karakter[$pos];
        }
        $token = Str::upper($string);
        $pemilih->token = $token;

        $cek = DB::table('pemilih')->where('token', $token)->get();

        if (count($cek) > 0) {
            Session::flash('error', 'Sistem token ada yang sudah pakai!');
            return redirect()->route('pemilih.index');
        } else {
            $pemilih->save();
            Session::flash('success', 'Data Pemilih Berhasil Ditambahkan!');
            return redirect()->route('pemilih.index');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $data['pemilih'] = Pemilih::find($id);
        $data['siswa'] = DB::table('siswa')->orderBy('nama', 'ASC')->get(); 
        return view('admins.pages.pemilih.form')->with($data);
        // dd($data['pemilih']);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $pemilih = Pemilih::find($id);
        $pemilih->siswa_id = $request->siswa_id;
        $pemilih->periode_id = $request->periode_id;
        $pemilih->save();

        Session::flash('success', 'Data Pemilih Berhasil Diupdate!');
        return redirect()->route('pemilih.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $pemilih = DB::table('pemilih')->where('id', $id)->delete();
        if ($pemilih) {
            Session::flash('success', 'Data Pemilih Berhasil Dihapus!');
            return redirect()->route('pemilih.index');
        }
    }
}
