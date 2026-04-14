<?php

namespace App\Http\Controllers;

use App\Models\Choose;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Semester;
use App\Models\Pembahasan;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ChooseExport;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class HistoryController extends Controller
{
    public function index(Request $request): View
    {
        $search = $request->get('search') ?: "";
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date == null && $end_date == null) {
            if (Auth::user()->role == 'admin') {
                $histories = $this->getHistoriesAdmin($search);
            } elseif (Auth::user()->role == 'dosen') {
                $histories = $this->getHistories($search);
            } elseif (Auth::user()->role == 'mahasiswa') {
                $histories = $this->getHistories($search);
            } elseif (Auth::user()->role == 'chaplin') {
                $histories = $this->getHistories($search);
            } elseif (Auth::user()->role == 'fungsionaris') {
                $histories = $this->getHistories($search);
            }
        } else {
            if (Auth::user()->role == 'admin') {
                $histories = Choose::where('status', '!=', null)->whereBetween('datetime', [$start_date . ' 00:00:00', $end_date . ' 23:59:00'])->select('*', 'chooses.status as status_reservasi')->paginate(5);
            } elseif (Auth::user()->role == 'dosen') {
                $histories = Choose::where('user_id', auth()->id())->where('status', '!=', null)->whereBetween('datetime', [$start_date . ' 00:00:00', $end_date . ' 23:59:00'])->select('*', 'chooses.status as status_reservasi')->paginate(5);
            } elseif (Auth::user()->role == 'mahasiswa') {
                $histories = Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->whereBetween('datetime', [$start_date . ' 00:00:00', $end_date . ' 23:59:00'])->select('*', 'chooses.status as status_reservasi')->paginate(5);
            } elseif (Auth::user()->role == 'chaplin') {
                $histories = Choose::where('user_id', auth()->id())->where('status', '!=', null)->whereBetween('datetime', [$start_date . ' 00:00:00', $end_date . ' 23:59:00'])->select('*', 'chooses.status as status_reservasi')->paginate(5);
            } elseif (Auth::user()->role == 'fungsionaris') {
                $histories = Choose::where('user_id', auth()->id())->where('status', '!=', null)->whereBetween('datetime', [$start_date . ' 00:00:00', $end_date . ' 23:59:00'])->select('*', 'chooses.status as status_reservasi')->paginate(5);
            }
        }

        $times = DB::table('time_chooses')->select('chooses_id', 'jam_mulai')->get();
        if (!empty($histories)) {
            foreach ($histories->items() as $history) {
                foreach ($times as $time) {
                    if ($history->id == $time->chooses_id) {
                        $history->datetime .= " " . $time->jam_mulai;
                        break;
                    }
                }
            }
        }

        $data = [
            'list_pembahasan' => Pembahasan::paginate(5),
            'list_semester' => Semester::all(),
            'histories' => $histories
        ];
        return view('history.index', compact('histories'), $data);
    }

    public function getHistories(string $search): LengthAwarePaginator
    {
        return Choose::where('chooses.status', '!=', null)
            ->join('users', 'user_id', '=', 'users.id')
            ->select('*', 'chooses.id as id', 'chooses.status as status_reservasi')
            ->where('chooses.create_user_id', '=', auth()->id())
            ->where('users.name', 'like', "%$search%")
            ->paginate(5);
    }

    public function getHistoriesAdmin(string $search): LengthAwarePaginator
    {
        return Choose::where('chooses.status', '!=', null)
            ->join('users', 'user_id', '=', 'users.id')
            ->select('*', 'chooses.id as id', 'chooses.status as status_reservasi')
            ->where('users.name', 'like', "%$search%")
            ->paginate(5);
    }

    public function export(Request $request): BinaryFileResponse
    {
        $date = Carbon::now()->format('d-m-Y');
        $time = Carbon::now()->format('H-i-s');
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date == null && $end_date == null) {
            if (Auth::user()->role == 'admin') {
                $histories = Choose::where('status', '!=', null)->select('*', 'chooses.status as status_reservasi')->get();
            } elseif (Auth::user()->role == 'dosen') {
                $histories = Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->select('*', 'chooses.status as status_reservasi')->get();
            }
        } else {
            if (Auth::user()->role == 'admin') {
                $histories = Choose::where('status', '!=', null)->whereBetween('created_at', [$start_date, $end_date])->select('*', 'chooses.status as status_reservasi')->get();
            } elseif (Auth::user()->role == 'dosen') {
                $histories = Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->whereBetween('created_at', [$start_date, $end_date])->select('*', 'chooses.status as status_reservasi')->get();
            }
        }
        return Excel::download(new ChooseExport($histories), 'histories' . '' . $date . '' . $time . '.xlsx');
    }

    public function calendar(Request $request): View
    {
        $search = $request->get('search') ?: "";
        $historiesCalendar = (Auth::user()->role == 'dosen' || Auth::user()->role == 'admin') ? $this->getHistoriesAdmin($search)
            : $this->getHistories($search);
        return view('calendar.index', compact('historiesCalendar'));
    }

    public function destroy(Choose $history): RedirectResponse
    {
        $history->delete();
        return back()
            ->with('alert_type', 'success')
            ->with('alert_message', 'Riwayat berhasil dihapus');
    }
}
