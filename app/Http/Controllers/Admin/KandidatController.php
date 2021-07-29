<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidat;
use Session;

class KandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $periode = DB::table('periode')->orderBy('nama', 'ASC')->get();
        // $kandidat = DB::table('kandidat as ka')
        //                 ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
        //                 ->join('kelas as k', 's.kelas_id', '=', 'k.id')
        //                 ->join('periode as p', 'ka.periode_id', '=', 'p.id')
        //                 ->select('s.nama as nama_siswa', 'ka.*', 'k.nama as nama_kelas', 'p.nama as nama_periode')
        //                 ->orderBy('k.created_at', 'DESC')
        //                 ->where('p.nama', Session::get('periode')->nama)
        //                 ->get();
        return view('admins.pages.kandidat.index', [
            'periode' => $periode,
            // 'kandidat' => $kandidat
        ]);
        // dd($kandidat);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['siswa'] = DB::table('siswa')->orderBy('nama', 'ASC')->get(); 
        return view('admins.pages.kandidat.form')->with($data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $kandidat = new Kandidat;
        $kandidat->siswa_id = $request->siswa_id;
        $kandidat->visi = $request->visi;
        $kandidat->misi = $request->misi;

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $store = $foto->store('admins/kandidat', 'public');
            $kandidat->foto = $store;
        } else {
            $kandidat->foto = 'admins/kandidat/default.png';
        }

        $periode = Session::get('periode');
        $kandidat->periode_id = $periode->id;
        $kandidat->jumlah_suara = 0;
        $kandidat->save();

        Session::flash('success', 'Data Kandidat Berhasil Ditambahkan!');
        return redirect()->route('kandidat.index');
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
        $kandidat = DB::table('kandidat as ka')
                        ->join('periode as p', 'ka.periode_id', '=', 'p.id')
                        ->select('ka.*', 'p.nama as nama_periode')
                        ->where('ka.id', $id)
                        ->first();
        $siswa = DB::table('siswa')->orderBy('nama', 'ASC')->get(); 
        return view('admins.pages.kandidat.form', [
            'siswa' => $siswa,
            'kandidat' => $kandidat
        ]);
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kandidat = DB::table('kandidat')->where('id', $id)->delete();
        if ($kandidat) {
            return response()->json([
                'status' => true,
                'message' => 'Berhasil menghapus kandidat!'
            ]);
        }
    }

    public function get_kandidat() 
    {
        $kandidat = DB::table('kandidat as ka')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as k', 's.kelas_id', '=', 'k.id')
                    ->join('periode as p', 'ka.periode_id', '=', 'p.id')
                    ->select('s.nama as nama_siswa', 'ka.*', 'k.nama as nama_kelas', 'p.nama as nama_periode')
                    ->orderBy('k.created_at', 'DESC');
        
        if (count($kandidat->get()) > 0) {
            if (!empty(Session::get('periode'))) {
                return response()->json([
                    'status' => true,
                    'message' => 'Success retrieve candidate data',
                    'data' => $kandidat->where('p.nama', Session::get('periode')->nama)
                                ->get()
                ]);
            } else {
                return response()->json([
                    'status' => true,
                    'message' => 'Success retrieve candidate data',
                    'data' => $kandidat->get()
                ]);
            }
        } else {
            return response()->json([
                'status' => false,
                'message' => 'Data Kandidat Kosong!',
                'data' => null
            ]);
        }
    }
}