<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class HasilController extends Controller
{
    public function index(): View
    {
        $kriteria = DB::table('kriteria')->get();
        foreach ($kriteria as $keyK => $dataK) {
            $id_kriteria[] = $dataK->kode;
            $bobot[] = $dataK->bobot;
            $atribut[] = $dataK->atribut;
        }
        $alternatif = DB::table('alternatif')->get();
        foreach ($alternatif as $keyT => $dataT) {
            $id_alternatif[] = $dataT->kode_alternatif;
        }
        $relasi = DB::table('relations')->where('user_id', '=', auth()->id())->get();
        $jmlh_bobot = $kriteria->sum('bobot');
        $jmlh_kriteria = $kriteria->count();
        $jmlh_alternatif = $alternatif->count();

        // Tahap 1 = Mencari Perpangkatan dari masing-masing bobot
        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            for ($j = 0; $j < $jmlh_alternatif; $j++) {
                $nilai[$j][$i] = DB::table('relations')
                    ->where('user_id', '=', auth()->id())
                    ->where('alternatif', $id_alternatif[$j])
                    ->where('kriteria', $id_kriteria[$i])
                    ->orderBy('nilai', 'ASC')
                    ->value('nilai');

                $pangkat_kriteria[$j][$i] = pow($nilai[$j][$i], 2);
            }
        }

        // Tahap 2 = Mencari Total Perpangkatan Sebelumnya per-kriteria
        $jmlh_pangkat = [];
        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            $jmlh_pangkat[$i] = 0;
            for ($j = 0; $j < $jmlh_alternatif; $j++) {
                $jmlh_pangkat[$i] += $pangkat_kriteria[$j][$i];
            }
        }

        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            if ($jmlh_pangkat[$i] !== 0) {
                $jmlh_pangkat[$i] = sqrt($jmlh_pangkat[$i]);
            } else {
                $jmlh_pangkat[$i] = 1;
            }
        }

        // Tahap 3 = Normalisasi
        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            for ($j = 0; $j < $jmlh_alternatif; $j++) {
                $nilai[$j][$i] = DB::table('relations')
                    ->where('user_id', '=', auth()->id())
                    ->where('alternatif', $id_alternatif[$j])
                    ->where('kriteria', $id_kriteria[$i])
                    ->orderBy('nilai', 'ASC')
                    ->value('nilai');

                $denominator = $jmlh_pangkat[$i];
                $normalisasi[$j][$i] = $denominator != 0 ? $nilai[$j][$i] / $denominator : 0;
            }
        }

        // Tahap 4 = Normalisasi Terbobot
        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            for ($j = 0; $j < $jmlh_alternatif; $j++) {
                $normalisasi_terbobot[$j][$i] = $bobot[$i] * $normalisasi[$j][$i];
            }
        }

        // Tahap 5 = Matriks Solusi Ideal (Positif dan Negatif)
        for ($i = 0; $i < $jmlh_kriteria; $i++) {
            for ($j = 0; $j < $jmlh_alternatif; $j++) {
                $array[$i][$j] = $normalisasi_terbobot[$j][$i];
                $positif[$i] = max($array[$i]);
                $negatif[$i] = min($array[$i]);
            }
        }

        // Tahap 6 = Jarak Solusi (Positif dan Negatif)
        $total_positif = [];
        $total_negatif = [];
        for ($i = 0; $i < $jmlh_alternatif; $i++) {
            $total_positif[$i] = 0;
            $total_negatif[$i] = 0;
            for ($j = 0; $j < $jmlh_kriteria; $j++) {
                $total_positif[$i] += pow(($positif[$j] - $normalisasi_terbobot[$i][$j]), 2);
                $total_negatif[$i] += pow(($negatif[$j] - $normalisasi_terbobot[$i][$j]), 2);
            }
            $hasil_positif[$i] = sqrt($total_positif[$i]);
            $hasil_negatif[$i] = sqrt($total_negatif[$i]);

            $epsilon = 1e-10;
            if ($hasil_positif[$i] < $epsilon) {
                $hasil_positif[$i] = $epsilon;
            }
            if ($hasil_negatif[$i] < $epsilon) {
                $hasil_negatif[$i] = $epsilon;
            }
        }

        DB::table('results')->truncate();

        // Tahap 7 = Mencari Preferensi
        for ($i = 0; $i < $jmlh_alternatif; $i++) {
            if ($hasil_positif[$i] + $hasil_negatif[$i] !== 0) {
                $preferensi[$i] = $hasil_negatif[$i] / ($hasil_positif[$i] + $hasil_negatif[$i]);
            } else {
                $preferensi[$i] = 0;
            }
            DB::table('results')->insert([
                'user_id' => auth()->id(),
                'alternatif' => $id_alternatif[$i],
                'hasil' => $preferensi[$i]
            ]);
        }

        $rangking = DB::table('results')
            ->where('user_id', '=', auth()->id())
            ->orderBy('hasil', 'desc')
            ->get();

        return view('Topsis.hasil', compact('kriteria', 'alternatif', 'relasi', 'jmlh_kriteria', 'jmlh_alternatif', 'normalisasi', 'normalisasi_terbobot', 'positif', 'negatif', 'hasil_positif', 'hasil_negatif', 'preferensi', 'rangking'));
    }
}
