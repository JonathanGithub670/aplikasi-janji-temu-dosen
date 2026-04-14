<?php

namespace App\Http\Controllers;

use App\Models\Semester;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;

class RegisterController extends Controller
{
    public function index(): View
    {
        $data = [
            'title' => 'Register',
            'list_semester' => Semester::all(),
        ];
        return view('register.index2', compact('data'));
    }

    public function store(Request $request): RedirectResponse
    {
        try {
            DB::beginTransaction();

            $existingUser = DB::table('users')->where('nim', $request->nim)->first();
            if ($existingUser) {
                return redirect()->route('register')->with('loginError', 'Registration failed! NIM/NIDN already registered.');
            }

            if ($request->nama_program_studi == null) {
                return redirect()->route('register')->with('loginError', 'Registration failed! Please select at least one Program Studi.');
            }

            $create_user_id = DB::table('users')->insertGetId([
                'nim' => $request->nim,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 0
            ]);

            if ($request->semester != null && is_numeric($request->semester)) {
                DB::table('user_semesters')->insert([
                    'semesters_id' => $request->semester,
                    'users_id' => $create_user_id
                ]);
            }

            if (gettype($request->nama_program_studi) == "array") {
                foreach ($request->nama_program_studi as $prodi) {
                    DB::table('program_studi')->insert([
                        'nama_program_studi' => $prodi,
                        'prodi_create_user_id' => $create_user_id
                    ]);
                }
            } else {
                DB::table('program_studi')->insert([
                    'nama_program_studi' => $request->nama_program_studi,
                    'prodi_create_user_id' => $create_user_id
                ]);
            }

            if ($request->jabatan) {
                DB::table('jabatan')->insert([
                    'jabatan' => $request->jabatan,
                    'create_user_id' => $create_user_id
                ]);
            } else {
                if ($request->role == "dosen") {
                    DB::table('jabatan')->insert([
                        'jabatan' => "lektor",
                        'create_user_id' => $create_user_id
                    ]);
                } else {
                    DB::table('jabatan')->insert([
                        'jabatan' => $request->role,
                        'create_user_id' => $create_user_id
                    ]);
                }
            }

            DB::commit();

            return redirect()->route('register')->with('success', 'Registration successful!');
        } catch (Exception $e) {
            DB::rollback();
            error_log($e);
            return redirect()->route('register')->with('loginError', 'Registration failed! Error: ' . $e->getMessage());
        }
    }
}
