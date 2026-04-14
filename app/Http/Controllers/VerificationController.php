<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class VerificationController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search') ?: "";

        if (Auth::user()->role == 'admin') {
            $user = $this->getReservationAdmin($search);
        }

        $users = User::where('status', '=', 0)
            ->where('nim', 'like', "%$search%")
            ->paginate(5);
        $data = [
            'user' => $user
        ];
        return view('verification.index', compact('user'), $data)
            ->with('users', $users);
    }

    public function acceptance(User $user, Request $request): View|RedirectResponse
    {
        try {
            if ($request->accept == 1) {
                $user->update(['status' => $request->accept]);
                return back()
                    ->with('alert_type', 'success')
                    ->with('alert_message', 'Akun berhasil diVerifikasi!');
            } else {
                $user->destroy($user->id);
                return back()
                    ->with('alert_type', 'danger')
                    ->with('alert_message', 'Akun gagal diVerifikasi !');
            }
        } catch (\Exception $e) {
            return view('errors.500');
        }
    }

    public function getReservation(string $search): LengthAwarePaginator
    {
        return DB::table('users')
            ->select('nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
            ->where('nim', 'like', "%$search%")
            ->where('chooses.user_id', '=', auth()->id())
            ->paginate(5);
    }

    public function getReservationAdmin(string $search): LengthAwarePaginator
    {
        return DB::table('users')
            ->select('nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
            ->where('nim', 'like', "%$search%")
            ->paginate(5);
    }
}
