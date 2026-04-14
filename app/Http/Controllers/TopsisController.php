<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class TopsisController extends Controller
{
    public function index(): View
    {
        $kriteria = DB::table('kriteria')->get();
        $alternatif = DB::table('alternatif')->get();
        DB::table('results')->delete();
        return view('Topsis.index', ['kriteria' => $kriteria, 'alternatif' => $alternatif]);
    }

    public function create(Request $request): RedirectResponse
    {
        $request->validate([
            'kode' => 'required|max:10',
            'nama' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ]);

        DB::table('kriteria')->insert([
            'kode' => strtoupper($request->kode),
            'nama_kriteria' => $request->nama,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function edit(string $kode): View
    {
        $kriteria = DB::table('kriteria')->where('kode', $kode)->first();
        return view('Topsis.edit', ['kriteria' => $kriteria]);
    }

    public function update(Request $request, string $kode): RedirectResponse
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
            'atribut' => 'required',
            'bobot' => 'required',
        ]);

        DB::table('kriteria')->where('kode', $kode)->update([
            'kode' => $request->kode,
            'namakriteria' => $request->nama,
            'atribut' => $request->atribut,
            'bobot' => $request->bobot
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroy(string $kode): RedirectResponse
    {
        DB::table('kriteria')->where('kode', $kode)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function createalternatif(Request $request): RedirectResponse
    {
        $request->validate([
            'kode' => 'required|max:10',
            'nama' => 'required',
        ]);

        DB::table('alternatif')->insert([
            'kode_alternatif' => strtoupper($request->kode),
            'nama_alternatif' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Data berhasil disimpan.');
    }

    public function alternatifedit(string $kode): View
    {
        $alternatif = DB::table('alternatif')->where('kode', $kode)->first();
        return view('Topsis.edit', ['alternatif' => $alternatif]);
    }

    public function alternatifupdate(Request $request, string $kode): RedirectResponse
    {
        $request->validate([
            'kode' => 'required',
            'nama' => 'required',
        ]);

        DB::table('alternatif')->where('kode_alternatif', $kode)->update([
            'kode_alternatif' => $request->kode,
            'nama_alternatif' => $request->nama,
        ]);

        return redirect()->back()->with('success', 'Data berhasil diperbarui.');
    }

    public function destroyalternatif(string $kode): RedirectResponse
    {
        DB::table('alternatif')->where('kode_alternatif', $kode)->delete();
        DB::table('relations')->where('alternatif', $kode)->delete();

        return redirect()->back()->with('success', 'Data berhasil dihapus.');
    }

    public function alternatifpenilaian(string $kode): View
    {
        $alternatif = DB::table('alternatif')->where('kode', $kode)->first();
        return view('Topsis.edit', ['alternatif' => $alternatif]);
    }

    public function alternatifinsertpenilaian(Request $request): RedirectResponse
    {
        $id_alternatif = $request->input('id_alternatif');
        $id_kriteria = $request->input('id_kriteria');
        $penilaian = $request->input('nilai');

        foreach ($id_kriteria as $index => $id_kriteria_value) {
            $existingData = DB::table('relations')
                ->where('user_id', '=', auth()->id())
                ->where('alternatif', $id_alternatif)
                ->where('kriteria', $id_kriteria_value)
                ->first();

            if ($existingData) {
                DB::table('relations')
                    ->where('user_id', '=', auth()->id())
                    ->where('alternatif', $id_alternatif)
                    ->where('kriteria', $id_kriteria_value)
                    ->update(['nilai' => $penilaian[$index]]);
            } else {
                $insertData = [
                    'user_id' => auth()->id(),
                    'alternatif' => $id_alternatif,
                    'kriteria' => $id_kriteria_value,
                    'nilai' => $penilaian[$index]
                ];
                DB::table('relations')->insert($insertData);
            }
        }

        return redirect()->back()->with('success', 'Data berhasil ditambah.');
    }
}
