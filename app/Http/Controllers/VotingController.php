<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\WaktuVoting;
use Session;

class VotingController extends Controller
{
    private $periode;
    private $dateNow;
    private $timeNow;

    public function __construct()
    {
        $this->periode = DB::table('periode')->where('status', 'active')->first();
        $this->dateNow = date('Y-m-d');
        $this->timeNow = date('H:i:s');
    }
    public function home()
    {
        return redirect('siswa');
    }
    public function index()
    {
        // dd(now());
        return view('siswa.voting');
    }
    public function mulai_voting()
    {
        $kandidat = DB::table('kandidat as ka')
                    ->join('periode as p', 'ka.periode_id', '=', 'p.id')
                    ->join('siswa as s', 'ka.siswa_id', '=', 's.id')
                    ->join('kelas as ke', 's.kelas_id', '=', 'ke.id')
                    ->select('p.nama as nama_periode', 'ka.*', 
                    's.nama as nama_siswa', 'ke.nama as nama_kelas')
                    ->orderBy('ka.kategori', 'DESC')
                    ->orderBy('ka.no_urut', 'ASC')
                    ->orderBy('ka.created_at', 'DESC');
                    // ->where('p.id', )
                    // ->get();
        
        if (!empty(Session::get('token'))) {

            if (!empty($this->periode->id)) {

                $user = DB::table('pemilih')
                        ->join('siswa', 'pemilih.siswa_id', '=', 'siswa.id')
                        ->select('siswa.nama as nama_siswa', 'siswa.jenis_kelamin as jk', 'pemilih.*')
                        ->where('pemilih.token', Session::get('token'))
                        ->first();

                if ($user->status_id == 1) {
                    $waktu_voting = DB::table('waktu_voting')
                                ->where('periode_id', $this->periode->id)
                                ->first();
                
                    $timeNow = time();

                    if ($user->jk == 'Laki - laki') {
                        $kandidat = $kandidat->where('p.id', $this->periode->id)
                                            ->where('ka.kategori', 'ketua')
                                            ->get();
                    } else if($user->jk == 'Perempuan') {
                        $kandidat = $kandidat->where('p.id', $this->periode->id)
                                            ->get();
                    } else {
                        $kandidat = [];
                    }
                    return view('siswa.kandidat', compact('kandidat', 'user', 'waktu_voting', 'timeNow'));
                } else {
                    Session::flash('error', 'Token sudah digunakan!');
                    return redirect('siswa/voting/login');
                }
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
            if (strlen($token) == 6) {
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
                Session::flash('error', 'Token hanya 6 digit!');
                return redirect('siswa/voting/login');
            }
        } else {
            Session::flash('error', 'Silahkan masukkan token!');
            return redirect('siswa/voting/login');
        }
    }

    public function simpan_suara(Request $request)
    {
        if ($request->ajax()) {

            $id = $request->id;
            $token = Session::get('token');
            $kandidat = DB::table('kandidat')->where('id', $id)->get();
            $pemilih = DB::table('pemilih')->where('token', $token)->get();
            $waktu = DB::table('waktu_voting')->where('periode_id', $this->periode->id)->first();
            $dateEnd = $waktu->tanggal_selesai;
            $timeEnd = $waktu->jam_selesai;

            foreach ($pemilih as $key => $pe) {
                $status = $pe->status_id;
            }

            if ($status == 1) {
                if ($this->dateNow >= $dateEnd) {
                    if ($this->timeNow >= $timeEnd) {
                        return response()->json([
                            'status' => false,
                            'message' => 'Waktu Voting Sudah Selesai! Anda Tidak Bisa Voting!',
                            'code' => 500,
                            'url' => route('logout_siswa')
                        ]);
                    }
                }
                foreach ($kandidat as $key => $ka) {
                    $jumlah_suara = $ka->jumlah_suara;
                }
                // Update jumlah suaranya
                DB::table('kandidat')->where('id', $id)->update([
                    'jumlah_suara' => $jumlah_suara + 1
                ]);
                // Update status tokennya
                DB::table('pemilih')->where('token', $token)->update([
                    'status_id' => 2
                ]);
                return response()->json([
                    'status' => true,
                    'message' => 'Berhasil memilih kandidat!',
                    'url' => route('sudah_voting')
                ]);
            } else {
                Session::flash('error', 'Token sudah digunakan!');
                return redirect('siswa/voting/login');
            }
        }
    }

    public function selesai_voting()
    {
        return view('siswa.selesai');
    }

    public function logout_siswa()
    {
        Session::forget('token');
        Session::flash('success', 'Anda Berhasil Logout!');
        return redirect('siswa/voting/login');
    }
}
