<?php

namespace App\Http\Controllers;

use App\Models\Choose;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function dashboard()
    {
            $pengguna = User::where('status', true)->count();
            $pertemuan = Choose::count();
            $histories = (Auth::user()->role == 'dosen' || Auth::user()->role == 'admin') ?
            $this->getHistoriesAdmin()->count() : $this->getHistories()->count();
            $verifikasi_user = User::where('status', false)->count();
            if (Auth::user()->role != 'dosen' || Auth::user()->role != 'mahasiswa'){
                return view('dashboard.index')
                    ->with('pengguna', $pengguna)
                    ->with('pertemuan', $pertemuan)
                    ->with('histories', $histories)
                    ->with('verifikasi_user', $verifikasi_user);
            }else{
                return back();
            }
    }

    public function getHistories()
    {
        return Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->get();
    }

    public function getHistoriesAdmin()
    {
        return Choose::where('status', '!=', null)->get();
    }
    

}
