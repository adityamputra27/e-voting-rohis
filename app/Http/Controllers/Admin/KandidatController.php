<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kandidat;
use Session;
use Illuminate\Support\Facades\Storage;

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
        return view('admins.pages.kandidat.index', [
            'periode' => $periode,
        ]);
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

        // Generate no_urut
        $lastNoUrut = DB::table('kandidat')
                        ->select('no_urut')
                        ->where('kategori', '=', $request->kategori)
                        ->orderBy('created_at', 'DESC')
                        ->first();
        
        $noUrut = $lastNoUrut == NULL ? $noUrut = '01' : $noUrut = sprintf('%02d', substr($lastNoUrut->no_urut, 0) + 1);

        if ($request->file('foto')) {
            $foto = $request->file('foto');
            $store = $foto->store('admins/kandidat', 'public');
            $kandidat->foto = $store;
        } else {
            $kandidat->foto = 'admins/kandidat/default.png';
        }

        $periode = DB::table('periode')->where('status', 'active')->first();
        $kandidat->periode_id = $periode->id;
        $kandidat->jumlah_suara = 0;
        $kandidat->kategori = $request->kategori;
        $kandidat->no_urut = $noUrut;
        $kandidat->save();
        // dd($kandidat);
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
        $kandidat = Kandidat::find($id);
        $kandidat->siswa_id = $request->siswa_id;
        $kandidat->visi = $request->visi;
        $kandidat->misi = $request->misi;

        if ($request->file('foto')) {
            // unlink jika ada gambar yg sama
            if ($kandidat->foto && file_exists(storage_path('app/public/'.$kandidat->foto))) {
                Storage::delete('public/'.$kandidat->foto);
            }
            $foto = $request->file('foto');
            $store = $foto->store('admins/kandidat', 'public');
            $kandidat->foto = $store;
        } else {
            $kandidat->foto = 'admins/kandidat/default.png';
        }

        $periode = DB::table('periode')->where('status', 'active')->first();
        $kandidat->periode_id = $periode->id;
        $kandidat->jumlah_suara = 0;
        $kandidat->kategori = $request->kategori;
        $kandidat->save();

        Session::flash('success', 'Data Kandidat Berhasil Diupdate!');
        return redirect()->route('kandidat.index');
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

    public function getKandidat(Request $request) 
    {
        if ($request->ajax()) {
            $periodeId = $request->get('periodeId');
            $namaKandidat = $request->get('namaKandidat');

            $kandidat = DB::table('kandidat as ka')
                        ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                        ->join('kelas as k', 's.kelas_id', '=', 'k.id')
                        ->join('periode as p', 'ka.periode_id', '=', 'p.id')
                        ->select('s.nama as nama_siswa', 'ka.*', 'k.nama as nama_kelas', 'p.nama as nama_periode')
                        ->orderBy('ka.kategori', 'DESC')
                        ->orderBy('ka.no_urut', 'ASC')
                        ->orderBy('k.created_at', 'DESC');

            if ($periodeId == null) {
                $periode = DB::table('periode')->where('status', 'active')->first();
            } else {
                $periode = DB::table('periode')
                            ->where('id', $periodeId)
                            ->first();
            }

            $cek = $kandidat->where('p.nama', $periode->nama)->get();
            
            if (count($cek) > 0) {
                if (!empty($periode)) {
                    if (!empty($namaKandidat)) {
                        $searchData = $kandidat->where('p.nama', $periode->nama)
                                    ->where('s.nama', 'LIKE', "%$namaKandidat%")
                                    ->get();
                        if (count($searchData) > 0) {
                            return response()->json([
                                'status' => true,
                                'message' => 'Success retrieve candidate data',
                                'data' => $searchData
                            ]);
                        } else {
                            return response()->json([
                                'status' => false,
                                'message' => 'Hasil Pencarian Nama Kandidat : <b>'.$namaKandidat.'</b> Tidak Ditemukan!',
                                'data' => null
                            ]);
                        }
                    } else {
                        return response()->json([
                            'status' => true,
                            'message' => 'Success retrieve candidate data',
                            'data' => $kandidat->where('p.nama', $periode->nama)
                                        ->get()
                        ]);
                    }
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
                    'message' => 'Data Kandidat <b>Periode '.$periode->nama.'</b> Kosong!',
                    'data' => null
                ]);
            }
        }
    }
}
