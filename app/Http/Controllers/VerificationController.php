<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Choose;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;

class VerificationController extends Controller
{
    public function index(Request $request)
    {
        $search = $request->get('search')?:"";
        // $user = (Auth::user()->role == 'admin') ?$this->getReservationAdmin($search) :
        // $this->getReservationAdmin($search);
        
        if (Auth::user()->role == 'admin') {
            $user = $this->getReservationAdmin($search);
        }

        // $users = User::where('status', false)->get();
        $users = User::where('status','=', 0)
        ->where('nim','like',"%$search%")
        ->paginate(5);
        $data = [
            'user'=> $user
        ];
        return view('verification.index',compact('user'),$data)
            ->with('users', $users);
    }

    public function acceptance(User $user, Request $request)
    {
        # Update data disini
        try {
            // $user->update(['status' => $request->accept]);
            // return back()
            //     ->with('alert_type', 'success')
            //     ->with('alert_message', 'Verifikasi berhasil!');
            if($request->accept == 1){
                $user->update(['status' => $request->accept]);
                return back()
                    ->with('alert_type', 'success')
                    ->with('alert_message', 'Akun berhasil diVerifikasi!');
            }else{
                $user->destroy($user->id);
                return back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Akun gagal diVerifikasi !');
            }
                
        } catch (\Exception $e) {
            // abort(500, $e->getMessage());
            return view('errors.500');
        }
    }
    public function getReservation($search)
    {
        // return Choose::where('user_id', auth()->id())->get();
        return  DB::table('users')
        // ->select('nim','name','email','role','users.id as id_users', 'users.status as status_users')
        ->select('nim','name','role','users.id as id_users', 'users.status as status_users')
        ->where('nim','like',"%$search%")
        ->where('chooses.user_id','=',auth()->id())
        ->paginate(5);
    }

    public function getReservationAdmin($search)
    {
        // return Choose::all();
        return  DB::table('users')
        // ->select('nim','name','email','role','users.id as id_users', 'users.status as status_users')
        ->select('nim','name','role','users.id as id_users', 'users.status as status_users')
        ->where('nim','like',"%$search%")
        ->paginate(5);
    }
    // public function changepassword() {
    //     return view('verification.edit.index');
    // }
}
