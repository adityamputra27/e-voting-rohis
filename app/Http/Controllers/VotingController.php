<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WaktuVoting;
use Session;

class VotingController extends Controller
{
    public function index()
    {
        return view('siswa.voting');
    }
    public function mulai_voting()
    {
        $kandidat = DB::table('kandidat as ka')
                    ->join('periode as p', 'ka.periode_id', '=', 'p.id')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as ke', 's.kelas_id', '=', 'ke.id')
                    ->select('p.nama as nama_periode', 'ka.*', 's.nama as nama_siswa', 'ke.nama as nama_kelas');
                    // ->where('p.id', )
                    // ->get();
        
        if (!empty(Session::get('token'))) {
            if (!empty(Session::get('periode')->id)) {

                $user = DB::table('pemilih')
                ->join('siswa', 'pemilih.siswa_id', '=', 'siswa.id')
                ->select('siswa.nama as nama_siswa', 'siswa.jenis_kelamin as jk')
                ->where('pemilih.token', Session::get('token'))
                ->first();

                $waktu_voting = DB::table('waktu_voting')
                                ->where('periode_id', Session::get('periode')->id)
                                ->first();
                
                $timeNow = time();

                if ($user->jk == 'Laki - laki') {
                    $kandidat = $kandidat->where('p.id', Session::get('periode')->id)
                                        ->where('ka.kategori', 'ketua')
                                        ->get();
                } else if($user->jk == 'Perempuan') {
                    $kandidat = $kandidat->where('p.id', Session::get('periode')->id)
                                        ->get();
                } else {
                    $kandidat = [];
                }
                return view('siswa.kandidat', compact('kandidat', 'user', 'waktu_voting', 'timeNow'));
                // dd(strtotime($waktu_voting->tanggal_mulai. ' ' .$waktu_voting->jam_mulai));
                // echo time() * 1000;
            } else {
                Session::flash('error', 'Periode belum di set, harap hubungi admin!');
                return redirect('siswa/voting/login');
            }
        } else {
            Session::flash('error', 'Mohon masukkan token untuk akses!');
            return redirect('siswa/voting/login');
        }
    }
    public function cektoken(Request $request)
    {
        $token = $request->token;

        $cek = DB::table('pemilih')->where('token', $token)->first();
        $status = DB::table('pemilih')
                    ->where(['token' => $token, 'status_id' => 1])
                    ->first();
        
        if (!empty($token)) {
            if (!$cek) {
                Session::flash('error', 'Token yang anda masukkan salah!');
                return redirect('siswa/voting/login');
            } else {
                if (!$status) {
                    Session::flash('error', 'Token sudah digunakan!');
                    return redirect('siswa/voting/login');
                } else {
                    Session::put('token', $token);
                    Session::flash('success', 'Anda berhasil masuk! Silahkan pilih ketua / keputrian. Pilihan anda menentukan untuk ekskul ROHIS kedepannya!');
                    return redirect('siswa/voting');
                }
            }
        } else {
            Session::flash('error', 'Silahkan masukkan token!');
            return redirect('siswa/voting/login');
        }
    }

    public function simpan_suara(Request $request)
    {
        if ($request->ajax()) {
            return 'OKE';
        }
    }

    public function logout_siswa()
    {
        Session::forget('token');
        Session::flash('success', 'Anda Berhasil Logout!');
        return redirect('siswa/voting/login');
    }
}
