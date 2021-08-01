<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Siswa;
use App\Models\Kelas;
use Session;

class SiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['siswa'] = Siswa::with('kelas')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.siswa.index')->with($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['kelas'] = DB::table('kelas')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.siswa.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $siswa = new Siswa;
        $siswa->nama = $request->nama;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->no_telp = $request->no_telp;

        $kelas = Kelas::find($request->kelas_id);
        $siswa->nama_kelas = $kelas->nama;
        $siswa->save();

        Session::flash('success', 'Data Siswa Berhasil Ditambahkan!');
        return redirect()->route('siswa.index');
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
        $data['siswa'] = DB::table('siswa')->where('id', $id)->orderBy('nama', 'ASC')->first();
        $data['kelas'] = DB::table('kelas')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.siswa.form')->with($data);
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
        $siswa = Siswa::find($id);
        $siswa->nama = $request->nama;
        $siswa->kelas_id = $request->kelas_id;
        $siswa->jenis_kelamin = $request->jenis_kelamin;
        $siswa->no_telp = $request->no_telp;

        $kelas = Kelas::find($request->kelas_id);
        $siswa->nama_kelas = $kelas->nama;
        $siswa->save();

        Session::flash('success', 'Data Siswa Berhasil Diupdate!');
        return redirect()->route('siswa.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $siswa = DB::table('siswa')->where('id', $id)->delete();
        if ($siswa) {
            Session::flash('success', 'Data Siswa Berhasil Dihapus!');
            return redirect()->route('siswa.index');
        }
    }
}
