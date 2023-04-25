<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules\Password;
use Illuminate\Support\Facades\DB;
use Exception;

class RegisterController extends Controller
{
    public function index() {
        
        return view('register.index2',[
            'title' => 'Register'
        ]);
    }
    // public function store(){
    //     return request()->all();
    // }
    public function store(Request $request) {
        // $validatedDate = $request->validate([
        //     'nim' => ['required','unique:users'],
        //     'name' => 'required|max:255',
        //     // 'username' => ['required' , 'min:5' , 'max:255' , 'unique:users'],
        //     // 'email' => ['required','unique:users'],
        //     // 'email' => ['required','email:dns','unique:users'],
        //     'password' => 'required|min:5|max:255', 
        //     //'password' => [ 'required', Password::min(8)->mixedCase()->letters()->numbers()->symbols()->uncompromised()],
        //     'role' =>'required',
        // ]);
        // $validatedDate['password'] = bycrypt($validatedDate['password']);
        // $validatedDate['password'] = Hash::make($validatedDate['password']);

        // User::create($validatedDate);

        // $request->session()->flash('success' , 'Registration successfull! Please Login');

        // return redirect()->route('login')->with('success' , 'Registration successfull! Please
        // Login');
        
        
        try {

            if($request->nama_program_studi == null){
                return redirect()->route('register')->with('loginError' , 'Registration failed! Please check the form!');
            }

            DB::table('users')->insert([
                'nim' =>  $request->nim,
                'name' => $request->name,
                'password' => Hash::make($request->password),
                'role' => $request->role,
                'status' => 0
            ]);   

            $create_user_id = DB::table('users')->where('nim','=',$request->nim)->first();

            if(gettype($request->nama_program_studi) == "array"){
                foreach ($request->nama_program_studi as $prodi) {
                    DB::table('program_studi')->insert([
                        'nama_program_studi' => $prodi,
                        'prodi_create_user_id' => $create_user_id->id
                    ]);
                }
            }else{
                DB::table('program_studi')->insert([
                    'nama_program_studi' => $request->nama_program_studi,
                    'prodi_create_user_id' => $create_user_id->id
                ]);
            }

            if($request->jabatan){
                DB::table('jabatan')->insert([
                    'jabatan' => $request->jabatan,
                    'create_user_id' => $create_user_id->id
                ]);
            }else{
                if($request->role == "dosen"){
                    DB::table('jabatan')->insert([
                        'jabatan' => "lektor",
                        'create_user_id' => $create_user_id->id
                    ]);
                }else{
                    DB::table('jabatan')->insert([
                        'jabatan' => $request->role,
                        'create_user_id' => $create_user_id->id
                    ]);
                }
            }

            return redirect()->route('register')->with('success' , 'Registration successfull! ');
          }catch(Exception $e) {
            return redirect()->route('register')->with('loginError' , 'Registration failed! Please check the form!');
          }

        
    }
    // public function show()
    // {
    //     return request()->all();
    //     User::show($validatedDate);
    // }
    
}