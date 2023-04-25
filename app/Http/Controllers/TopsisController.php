<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use App\Models\Pembahasan;

class TopsisController extends Controller
{
    public function kriteria(){
        $data = [
            'list_pembahasan'=>Pembahasan::all(),
        // 'roles' => Role::all()
        ];
        return view('topsis.kriteria.index',$data);
    }
    public function alternatif(){
        return view('topsis.alternatif.index');
    }
    public function storeKriteria(Request $request){

    }
}
