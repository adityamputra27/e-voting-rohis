<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WaktuVoting;
use Carbon\Carbon;
use Session;

class WaktuVotingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $waktu_voting = DB::table('waktu_voting')
                        ->orderBy('periode_id')
                        ->join('periode', 'waktu_voting.periode_id', 'periode.id')
                        ->select('waktu_voting.*', 'periode.*')
                        ->get();
        return view('admins.pages.waktu_voting.index', compact('waktu_voting'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $periode = DB::table('periode')->orderBy('nama', 'ASC')->get();
        return view('admins.pages.waktu_voting.form', compact('periode'));
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

        $waktu_voting = new WaktuVoting;
        $waktu_voting->periode_id = $periode->id ?? $request->periode_id;
        $waktu_voting->tanggal_mulai = Carbon::parse($request->tanggal_mulai)->format('Y-m-d');
        $waktu_voting->jam_mulai = Carbon::parse($request->jam_mulai)->format('H:i:s');
        $waktu_voting->tanggal_selesai = Carbon::parse($request->tanggal_selesai)->format('Y-m-d');
        $waktu_voting->jam_selesai = Carbon::parse($request->jam_selesai)->format('H:i:s');
        $waktu_voting->save();

        Session::flash('success', 'Data Waktu Voting Berhasil Ditambahkan!');
        return redirect()->route('waktu-voting.index');
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
        $waktu = DB::table('waktu_voting')->orderBy('periode_id', 'ASC')->where('id', $id)->first();
        return view('admins.pages.waktu_voting.form', compact('waktu'));
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
        $periode = DB::table('periode')->where('status', 'active')->first();

        $waktu_voting = WaktuVoting::find($id);
        $waktu_voting->periode_id = $periode->id ?? $request->periode_id;
        $waktu_voting->tanggal_mulai = Carbon::parse($request->tanggal_mulai)->format('Y-m-d');
        $waktu_voting->jam_mulai = Carbon::parse($request->jam_mulai)->format('H:i:s');
        $waktu_voting->tanggal_selesai = Carbon::parse($request->tanggal_selesai)->format('Y-m-d');
        $waktu_voting->jam_selesai = Carbon::parse($request->jam_selesai)->format('H:i:s');
        $waktu_voting->save();

        Session::flash('success', 'Data Waktu Voting Berhasil Diupdate!');
        return redirect()->route('waktu-voting.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
