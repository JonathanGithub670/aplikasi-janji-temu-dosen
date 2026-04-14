<?php

namespace App\Http\Controllers;


use App\Http\Controllers\DummyList;
use Barryvdh\DomPDF\Facade\Pdf;
use App\Models\Choose;
use App\Models\User;
use App\Models\Semester;
use App\Models\Pembahasan;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Contracts\Database\Query\Builder as QueryBuilder;
use Illuminate\Database\Query\Builder as DatabaseQueryBuilder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Exception;

class ListController extends Controller
{
    private static function indoDayName(string $day): string
    {
        $days = [
            'monday' => 'senin',
            'tuesday' => 'selasa',
            'wednesday' => 'rabu',
            'thursday' => 'kamis',
            'friday' => 'jumat',
            'saturday' => 'sabtu',
            'sunday' => 'minggu',
        ];
        return $days[strtolower($day)] ?? $day;
    }

    // public function index(Request $request)
    // {
    //     $search = $request->get('search')?:"";
    //     $lists = (Auth::user()->role == 'superadmin'||Auth::user()->role == 'admin' ) ? $this->getReservationAdmin($search) : $this->getReservation($search);
    //     $data = [
    //         'list_pembahasan'=>Pembahasan::all(),
    //         'list_pembahasan'=>Pembahasan::paginate(5),
    //         'lists'=> $lists
    //     ];
    //     return view('list.index', compact('lists'));
    //     return view('list.index', $data);
    // }

    public function index(Request $request)
    {
        $search = $request->get('search') ?: "";
        $start_date = $request->start_date;
        $end_date = $request->end_date;
        $lists = [];
        if ($start_date == null && $end_date == null) {
            if (Auth::user()->role == 'admin') {
                $lists = $this->getReservationAdmin($search);
            } elseif (Auth::user()->role == 'dosen') {
                $lists = Choose::where('user_id', auth()->id())->paginate(5);
            } elseif (Auth::user()->role == 'mahasiswa') {
                // Mahasiswa sees appointments they created
                $lists = Choose::where('create_user_id', auth()->id())->paginate(5);
            } elseif (Auth::user()->role == 'chaplin') {
                $lists = Choose::where('user_id', auth()->id())->paginate(5);
            } elseif (Auth::user()->role == 'fungsionaris') {
                $lists = Choose::where('user_id', auth()->id())->paginate(5);
            }
        } else {
            if (Auth::user()->role == 'admin') {
                $lists = Choose::whereBetween('date', [$start_date, $end_date])->paginate(5);
            } elseif (Auth::user()->role == 'dosen') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('date', [$start_date, $end_date])->paginate(5);
            } elseif (Auth::user()->role == 'mahasiswa') {
                // Mahasiswa sees appointments they created
                $lists = Choose::where('create_user_id', auth()->id())->whereBetween('date', [$start_date, $end_date])->paginate(5);
            } elseif (Auth::user()->role == 'chaplin') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('date', [$start_date, $end_date])->paginate(5);
            } elseif (Auth::user()->role == 'fungsionaris') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('date', [$start_date, $end_date])->paginate(5);
            }
        }
        // $search = $request->get('search')?:"";
        // $lists = (Auth::user()->role == 'admin'||Auth::user()->role == 'dosen'||Auth::user()->role == 'chaplin'
        // ||Auth::user()->role == 'fungsionaris' ) ? $this->getReservationAdmin($search)
        // : $this->getReservation($search) || $this->getReservation2();

        $times = DB::table('time_chooses')->select('chooses_id', 'jam_mulai')->get();
        if (!empty($lists)) {
            foreach ($lists->items() as $list) {
                foreach ($times as $time) {
                    if ($list->id == $time->chooses_id) {
                        $list->date = (string) date('Y-m-d', strtotime($list->date));
                        $list->date .= " " . $time->jam_mulai;
                        break;
                    }
                }
            }
        }

        $data = [
            'list_pembahasan' => Pembahasan::all(),
            //'list_pembahasan'=>Pembahasan::paginate(5),
            'list_semester' => Semester::all(),
            'lists' => $lists
        ];

        // return view('list.index', compact('lists'));
        // return view('list.index', $data);
        return view('list.index', compact('lists'), $data);


    }

    public function calendar(Request $request)
    {

        $chooses = [];
        $search = $request->get('search') ?: "";
        if (Auth::user()->role == 'admin') {
            $chooses = Choose::where('status', '!=', null)->paginate(5) ? $this->getReservationAdminCalendar($search)
                : $this->getReservationCalendar($search);
        } elseif (Auth::user()->role == 'dosen') {
            $chooses = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        } elseif (Auth::user()->role == 'mahasiswa') {
            $chooses = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5);
        } elseif (Auth::user()->role == 'chaplin') {
            $chooses = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        } elseif (Auth::user()->role == 'fungsionaris') {
            $chooses = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        }
        //        $data = [
//        // 'list_pembahasan'=>Pembahasan::all(),
//        // 'list_pembahasan'=>Pembahasan::paginate(5),
//        // 'list_semester'=>Semester::paginate(5),
//        'lists'=> $chooses
//        ];

        $chooses = DB::table('chooses')
            ->join('users', 'create_user_id', '=', 'users.id')
            ->where('chooses.user_id', '=', auth()->id())
            ->selectRaw("CAST(CONCAT(nim, ' | ', name) AS varchar(40)) as keterangan, date AS jam_mulai")
            ->get();
        //return $chooses->get();
        $routines = DB::table('routines')
            ->whereNot('keterangan', '=', 'ibadah')
            ->where('user_id', '=', auth()->id())
            ->selectRaw('CAST(keterangan as varchar(40)) as keterangan, jam_mulai, jam_selesai, hari');
        //return $routines->count() + $chooses->count();
        $blueprint_routine_month = $routines->get();
        //$lists = $routines->unionAll($chooses)->get();
        //return $lists;

        $period = DB::table('routine_periods')
            ->where('user_id', '=', auth()->id())
            ->first();

        $start_date = $period ? $period->mulai_perkuliahan : date('Y-m-d');
        $end_date = $period ? $period->selesai_perkuliahan : date('Y-m-d');

        $current_date = $start_date;
        $date_array = [];

        while ($current_date <= $end_date) {
            $day = self::indoDayName(Carbon::parse($current_date)->format('l'));
            $date_array[] = ['date' => $current_date, 'day' => $day];
            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }

        $result = [];

        foreach ($date_array as $date) {
            foreach ($blueprint_routine_month as $item) {
                if ($date['day'] == $item->hari) {
                    $dummy = new DummyList();
                    $dummy->keterangan = $item->keterangan;
                    $dummy->jam_mulai = $date['date'] . " " . $item->jam_mulai;
                    $dummy->jam_selesai = $date['date'] . " " . $item->jam_selesai;
                    $result[] = $dummy;
                }
            }
        }

        $time_chooses = DB::table('time_chooses')
            ->join('chooses', 'chooses_id', '=', 'chooses.id')
            ->where('chooses.user_id', '=', auth()->id())
            ->select('jam_mulai', 'jam_selesai')
            ->get();

        $choose_arr = [];
        if (count($time_chooses)) {
            $index = 0;
            for ($i = 0; $i < count($chooses); $i++) {
                if ($chooses[$i]->keterangan != "mengajar" && $chooses[$i]->keterangan != "istirahat") {
                    $temp = explode(" ", $chooses[$i]->jam_mulai);
                    $chooses[$i]->jam_mulai = $temp[0] . " " . $time_chooses[$index]->jam_mulai;
                    $chooses[$i]->jam_selesai = $temp[0] . " " . $time_chooses[$index]->jam_selesai;
                    $choose_arr[] = $chooses[$i];
                    $index++;
                }
            }
        }

        $lists = array_merge($result, $choose_arr);

        $dosen = DB::table('users')
            ->where('id', '=', auth()->id())
            ->first();

        $data = [
            'dosen' => $dosen,
            'lists' => $lists,
        ];

        return view('calendar.index', compact('data'));
    }

    public function getReservation($search)
    {
        if ($search != "") {
            //return filtered by nip mahasiswa
            return DB::table('chooses')
                ->join('users', 'create_user_id', '=', 'users.id')
                ->leftJoin('program_studi', 'users.nim', '=', 'program_studi.prodi_create_user_id')
                ->leftJoin('chooses_alternatif', 'chooses.id', '=', 'chooses_alternatif.chooses_id')
                ->leftJoin('alternatif', 'chooses_alternatif.alternatif_id', '=', 'alternatif.id_alternatif')
                ->leftJoin('results', 'results.alternatif', '=', 'alternatif.kode_alternatif')
                ->select('chooses.*', 'results.hasil', 'nama_program_studi', 'users.nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
                // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
                ->where('results.user_id', '=', auth()->id())
                ->where('chooses.user_id', '=', auth()->id())
                ->where('nim', 'like', "%$search%")
                ->orderByDesc('results.hasil')
                ->orderBy('date')
                ->paginate(5);
        } else {
            // return Choose::where('user_id', auth()->id())->get();
            return DB::table('chooses')
                ->join('users', 'user_id', '=', 'users.id')
                ->leftJoin('program_studi', 'users.nim', '=', 'program_studi.prodi_create_user_id')
                ->leftJoin('chooses_alternatif', 'chooses.id', '=', 'chooses_alternatif.chooses_id')
                ->leftJoin('alternatif', 'chooses_alternatif.alternatif_id', '=', 'alternatif.id_alternatif')
                ->leftJoin('results', 'results.alternatif', '=', 'alternatif.kode_alternatif')
                ->where('results.user_id', '=', auth()->id())
                ->select('chooses.*', 'results.hasil', 'nama_program_studi', 'users.nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
                // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
                ->where('chooses.user_id', '=', auth()->id())
                ->where('nim', 'like', "%$search%")
                ->orderByDesc('results.hasil')
                ->orderBy('date')
                ->paginate(5);
        }
    }

    public function getReservationAdmin($search)
    {
        if ($search != "") {
            //return filtered by nip mahasiswa
            return DB::table('chooses')
                ->join('users', 'create_user_id', '=', 'users.id')
                ->leftJoin('program_studi', 'users.nim', '=', 'program_studi.prodi_create_user_id')
                ->leftJoin('chooses_alternatif', 'chooses.id', '=', 'chooses_alternatif.chooses_id')
                ->leftJoin('alternatif', 'chooses_alternatif.alternatif_id', '=', 'alternatif.id_alternatif')
                ->leftJoin('results', 'results.alternatif', '=', 'alternatif.kode_alternatif')
                ->select('chooses.*', 'results.hasil', 'nama_program_studi', 'users.nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
                ->where('results.user_id', '=', auth()->id())
                // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
                ->where('nim', 'like', "%$search%")
                ->orderByDesc('results.hasil')
                ->orderBy('date')
                ->paginate(5);
        } else {
            // return Choose::all();
            return DB::table('chooses')
                ->join('users', 'user_id', '=', 'users.id')
                ->leftJoin('program_studi', 'chooses.create_user_id', '=', 'program_studi.prodi_create_user_id')
                ->leftJoin('chooses_alternatif', 'chooses.id', '=', 'chooses_alternatif.chooses_id')
                ->leftJoin('alternatif', 'chooses_alternatif.alternatif_id', '=', 'alternatif.id_alternatif')
                ->leftJoin('results', 'results.alternatif', '=', 'alternatif.kode_alternatif')
                ->where('results.user_id', '=', auth()->id())
                ->select('chooses.*', 'results.hasil', 'nama_program_studi', 'users.nim', 'name', 'role', 'users.id as id_users', 'users.status as status_users')
                //->select('chooses.*', 'nama_program_studi','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
                ->where('nim', 'like', "%$search%")
                //->groupBy('id', 'nama_program_studi','users.nim','name','role','id_users', 'status_users')
                ->orderByDesc('results.hasil')
                ->orderBy('date')
                ->paginate(5);
        }
    }

    public function getReservationCalendar($search)
    {
        // return Choose::where('user_id', auth()->id())->get();
        return DB::table('chooses')
            ->join('users', 'create_user_id', '=', 'users.id')
            ->selectRaw("CAST(CONCAT(nim, ' | ', name) AS varchar(40)) as keterangan, date")
            // ->select('chooses.*','nim','name','email','role','users.id as id_users', 'users.status as status_users')
            ->where('chooses.user_id', '=', auth()->id());
    }

    public function getReservationAdminCalendar($search)
    {
        // return Choose::where('user_id', auth()->id())->get();
        return DB::table('chooses')
            ->join('users', 'create_user_id', '=', 'users.id')
            ->selectRaw("CAST(CONCAT(nim, ' | ', name) AS varchar(40)) as keterangan, date");// ->select('chooses.*','nim','name','email','role','users.id as id_users', 'users.status as status_users')->paginate();
    }




    /**
     * Updating list
     * Mengupdate data yang akan diterima atau ditolak
     *
     * @param $id string ID dari data observasinya
     * @param $request Illuminate\Http\Request pengumpul data $_POST dan $_GET
     */
    public function acceptance($id = null, Request $request)
    {
        # Update data disini
        try {
            Choose::find($id)->update(['status' => filter_var($request->accept, FILTER_VALIDATE_BOOLEAN)]);
            return back()->with('success', "Reservasi berhasil " . $request->accept === 'true' ? 'diterima' : 'ditolak' . "!");
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function destroy(Choose $choose)
    {
        try {
            $choose->delete();
            return back()->with('success', 'Reservasi berhasil dihapus!');
        } catch (\Exception $e) {
            abort(500, $e->getMessage());
        }
    }

    public function lihat(Choose $choose)
    {
        $prodi = DB::table('program_studi')->select('nama_program_studi')->where('prodi_create_user_id', '=', $choose->create_user_id)->first()->nama_program_studi;

        $jabatan = DB::table('jabatan')->select('jabatan')->where('create_user_id', '=', $choose->user_id)->first()->jabatan;

        $jam_mulai = DB::table('time_chooses')->select('jam_mulai')->where('chooses_id', '=', $choose->id)->first()->jam_mulai;

        $choose->date .= " " . $jam_mulai;
        $choose->prodi = $prodi;
        $choose->jabatan = $jabatan;
        $choose->no_pdf = ChooseController::generateOrderNR($choose->id);

        return view('lihat.index', compact('choose'));
    }

    public function pdf(Choose $choose)
    {
        // echo $choose;
        $prodi = DB::table('program_studi')->select('nama_program_studi')->where('prodi_create_user_id', '=', $choose->create_user_id)->first()->nama_program_studi;

        $jabatan = DB::table('jabatan')->select('jabatan')->where('create_user_id', '=', $choose->user_id)->first()->jabatan;

        $jam_mulai = DB::table('time_chooses')->select('jam_mulai')->where('chooses_id', '=', $choose->id)->first()->jam_mulai;

        $choose->date .= " " . $jam_mulai;
        $choose->prodi = $prodi;
        $choose->jabatan = $jabatan;
        $choose->no_pdf = ChooseController::generateOrderNR($choose->id);
        $data = $choose->toArray();
        // $pdf = Pdf::loadView('lihat.index', compact('choose'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf = Pdf::loadView('lihat.indexpdf', compact('choose'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('invoice.pdf');
    }
    public function daftar_dosen()
    {
        $dosens = DB::table('users')
            ->select('id', 'name', 'nim')
            ->whereNot('role', '=', 'admin')
            ->WhereNot('role', '=', 'mahasiswa')
            ->paginate(8);

        return view('daftar_dosen.index', compact('dosens'));
    }

    public function jadwalDosen(Request $request)
    {
        $chooses = DB::table('chooses')
            ->join('users', 'create_user_id', '=', 'users.id')
            ->where('chooses.user_id', '=', $request->id)
            ->selectRaw("CAST(CONCAT(nim, ' | ', name) AS varchar(40)) as keterangan, date")
            ->get();
        //return $chooses->get();
        $routines = DB::table('routines')
            ->whereNot('keterangan', '=', 'ibadah')
            ->where('user_id', '=', $request->id)
            ->selectRaw('CAST(keterangan as varchar(40)) as keterangan, jam_mulai, jam_selesai, hari');
        //return $routines->count() + $chooses->count();
        $blueprint_routine_month = $routines->get();
        //$lists = $routines->unionAll($chooses)->get();
        //return $lists;

        $period = DB::table('routine_periods')
            ->where('user_id', '=', $request->id)
            ->first();

        $start_date = $period ? $period->mulai_perkuliahan : date('Y-m-d');
        $end_date = $period ? $period->selesai_perkuliahan : date('Y-m-d');

        $current_date = $start_date;
        $date_array = [];

        while ($current_date <= $end_date) {
            $day = self::indoDayName(Carbon::parse($current_date)->format('l'));
            $date_array[] = ['date' => $current_date, 'day' => $day];
            $current_date = date('Y-m-d', strtotime($current_date . ' +1 day'));
        }


        $result = array();

        foreach ($date_array as $date) {
            foreach ($blueprint_routine_month as $item) {
                if ($date['day'] == $item->hari) {
                    $dummy = new DummyList();
                    $dummy->keterangan = $item->keterangan;
                    $dummy->jam_mulai = $date['date'] . " " . $item->jam_mulai;
                    $dummy->jam_selesai = $date['date'] . " " . $item->jam_selesai;
                    $result[] = $dummy;
                }
            }
        }

        $time_chooses = DB::table('time_chooses')
            ->join('chooses', 'chooses_id', '=', 'chooses.id')
            ->where('chooses.user_id', '=', $request->id)
            ->select('jam_mulai', 'jam_selesai')
            ->get();

        $choose_arr = array();
        if (count($time_chooses)) {
            $index = 0;
            for ($i = 0; $i < count($chooses); $i++) {
                if ($chooses[$i]->keterangan != "mengajar" && $chooses[$i]->keterangan != "istirahat") {
                    $temp = explode(" ", $chooses[$i]->date);
                    $chooses[$i]->jam_mulai = $temp[0] . " " . $time_chooses[$index]->jam_mulai;
                    $chooses[$i]->jam_selesai = $temp[0] . " " . $time_chooses[$index]->jam_selesai;
                    $choose_arr[] = $chooses[$i];
                    $index++;
                }
            }
        }

        $lists = array_merge($result, $choose_arr);

        $dosen = DB::table('users')
            ->where('id', '=', $request->id)
            ->first();

        $data = [
            'dosen' => $dosen,
            'lists' => $lists
        ];

        // return view('list.index', compact('lists'));
        return view('calendar.index', compact('data'));
        // return view('list.index', compact('lists'));
        //return view('calendar.index', compact('lists'));
    }
}
// public function getReservation2(){
//     return Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->paginate(5);
// }
// public function update(Choose $lists)
// {
// Choose::destroy($lists->id);
// return redirect('/dashboard/list')->with('success','List has been deleted!');
// }
// public function update(Request $request, $id)
// {
// $lists = Choose::find($id)->update($request->all());
// return back()->with('success','Reservasi tervalidasi');
// }
