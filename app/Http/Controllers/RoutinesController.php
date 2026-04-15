<?php

namespace App\Http\Controllers;

use DateTime;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class RoutinesController extends Controller
{
    public function index(): View
    {
        $dosens = DB::table('users')
            ->select('id', 'name', 'nim')
            ->whereNot('role', '=', 'admin')
            ->WhereNot('role', '=', 'mahasiswa')
            ->paginate(8);

        return view('routines_dosen.index', compact('dosens'));
    }

    public function detail(Request $request): View
    {
        $dosen = DB::table('users')
            ->select('name', 'nim')
            ->where('id', '=', $request->id)
            ->first();

        $period = DB::table('routine_periods')
            ->where('user_id', '=', $request->id)
            ->first();

        $routines = DB::table('routines')
            ->where('user_id', '=', $request->id)
            ->paginate(10);

        $jam_off = DB::table('off_time')
            ->where('user_id', '=', $request->id)
            ->paginate(10);

        $data = [
            'dosen' => $dosen,
            'period' => $period,
            'routines' => $routines,
            'jam_off' => $jam_off,
        ];

        return view('routines_dosen.detail', compact('data'));
    }

    public function detail_dosen(): View
    {
        $dosen = DB::table('users')
            ->select('name', 'nim')
            ->where('id', '=', auth()->id())
            ->first();

        $period = DB::table('routine_periods')
            ->where('user_id', '=', auth()->id())
            ->first();

        $routines = DB::table('routines')
            ->where('user_id', '=', auth()->id())
            ->paginate(10);

        $jam_off = DB::table('off_time')
            ->where('user_id', '=', auth()->id())
            ->paginate(10);

        $data = [
            'dosen' => $dosen,
            'period' => $period,
            'routines' => $routines,
            'jam_off' => $jam_off,
        ];

        return view('routines_dosen.detail', compact('data'));
    }

    public function store(Request $request): RedirectResponse
    {
        DB::table('routines')
            ->insert([
                'user_id' => $request->user_id,
                'hari' => $request->hari,
                'keterangan' => $request->keterangan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai
            ]);

        return redirect()->back()->with('success-routines', 'Berhasil menambahkan rutinitas');
    }

    public function edit(Request $request): RedirectResponse
    {
        DB::table('routines')
            ->where('id', '=', $request->id)
            ->update([
                'user_id' => $request->user_id,
                'hari' => $request->hari,
                'keterangan' => $request->keterangan,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai
            ]);

        return redirect()->back()->with('success-routines', 'Berhasil mengubah rutinitas');
    }

    public function delete(Request $request): RedirectResponse
    {
        DB::table('routines')
            ->where('id', '=', $request->id)
            ->delete();

        return redirect()->back()->with('success-routines', 'Berhasil menghapus rutinitas');
    }

    public function perkuliahan(Request $request): RedirectResponse
    {
        $isExist = DB::table('routine_periods')
            ->where('user_id', '=', $request->user_id)
            ->first();

        if ($isExist) {
            DB::table('routine_periods')
                ->where('user_id', '=', $request->user_id)
                ->update([
                    'mulai_perkuliahan' => $request->mulai_perkuliahan,
                    'selesai_perkuliahan' => $request->selesai_perkuliahan
                ]);
        } else {
            DB::table('routine_periods')
                ->insert([
                    'user_id' => $request->user_id,
                    'mulai_perkuliahan' => $request->mulai_perkuliahan,
                    'selesai_perkuliahan' => $request->selesai_perkuliahan
                ]);
        }

        return redirect()->back()->with('tanggal_success', 'Berhasil mengganti periode rutinitas');
    }

    public function off_create(): View
    {
        return view('routines_dosen.tambah-off');
    }

    public function off_store(Request $request): RedirectResponse
    {
        $request->validate([
            'user_id' => 'required',
            'tanggal' => 'required',
            'fakeJam' => 'required|array|min:1',
        ]);

        $id = $request->user_id;
        $tanggal = DateTime::createFromFormat("m-d-Y", $request->tanggal)->format('Y-m-d');

        foreach ($request->fakeJam as $jam) {
            $times = explode(" - ", $jam);
            DB::table('off_time')
                ->insert([
                    'user_id' => $id,
                    'tanggal' => $tanggal,
                    'keterangan' => 'off',
                    'jam_mulai' => $times[0],
                    'jam_selesai' => $times[1]
                ]);
        }
        return redirect()->back()->with('success-off', 'Berhasil menambahkan jam off');
    }

    public function off_edit(Request $request): RedirectResponse
    {
        $id = $request->user_id;
        $tanggal = DateTime::createFromFormat("m-d-Y", $request->tanggal)->format('Y-m-d');

        DB::table('off_time')
            ->where('user_id', '=', $id)
            ->update([
                'tanggal' => $tanggal,
                'jam_mulai' => $request->jam_mulai,
                'jam_selesai' => $request->jam_selesai
            ]);
        return redirect()->back()->with('success-off', 'Berhasil mengubah jam off');
    }

    public function off_delete(Request $request): RedirectResponse
    {
        DB::table('off_time')->delete($request->id);
        return redirect()->back()->with('success-off', 'Berhasil menghapus jam off');
    }
}
