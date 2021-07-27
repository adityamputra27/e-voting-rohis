<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class VotingController extends Controller
{
    public function index()
    {
        return view('siswa.voting');
    }
}
