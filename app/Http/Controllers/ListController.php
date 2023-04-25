<?php

namespace App\Http\Controllers;


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


class ListController extends Controller
{
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
        $search = $request->get('search')?:"";
        $start_date = $request->start_date;
        $end_date = $request->end_date;

        if ($start_date == null && $end_date == null){
            if (Auth::user()->role == 'admin') {
                $lists = $this->getReservationAdmin($search);
            }elseif (Auth::user()->role == 'dosen') {
                $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservation($search) : $this->getReservationAdmin($search);
            }elseif (Auth::user()->role == 'mahasiswa') {
                $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5);
            }elseif (Auth::user()->role == 'chaplin') {
                $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservation($search) : $this->getReservationAdmin($search);
            }elseif (Auth::user()->role == 'fungsionaris') {
                $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
                ? $this->getReservation($search) : $this->getReservationAdmin($search);
            }
        }else {
            if (Auth::user()->role == 'admin') {
                $lists = Choose::whereBetween('datetime',[$start_date.' 00:00:00',$end_date.' 23:59:00'])->paginate(5);
            }elseif (Auth::user()->role == 'dosen') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('datetime',[$start_date.' 00:00:00',$end_date.' 23:59:00'])->paginate(5);
            }elseif (Auth::user()->role == 'mahasiswa') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('datetime',[$start_date.' 00:00:00',$end_date.' 23:59:00'])->paginate(5);
            }elseif (Auth::user()->role == 'chaplin') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('datetime',[$start_date.' 00:00:00',$end_date.' 23:59:00'])->paginate(5);
            }elseif (Auth::user()->role == 'fungsionaris') {
                $lists = Choose::where('user_id', auth()->id())->whereBetween('datetime',[$start_date.' 00:00:00',$end_date.' 23:59:00'])->paginate(5);
            }
        }
        // $search = $request->get('search')?:"";
        // $lists = (Auth::user()->role == 'admin'||Auth::user()->role == 'dosen'||Auth::user()->role == 'chaplin'
        // ||Auth::user()->role == 'fungsionaris' ) ? $this->getReservationAdmin($search)
        // : $this->getReservation($search) || $this->getReservation2();
        $data = [
        'list_pembahasan'=>Pembahasan::all(),
        //'list_pembahasan'=>Pembahasan::paginate(5),
        'list_semester'=>Semester::all(),
        'lists'=> $lists
        ];

        // return view('list.index', compact('lists'));
        // return view('list.index', $data);
        return view('list.index', compact('lists'), $data);


    }

    public function calendar(Request $request)
    {
        $search = $request->get('search')?:"";
        if (Auth::user()->role == 'admin') {
            $lists = Choose::where('status', '!=', null)->paginate(5) ? $this->getReservationAdminCalendar($search)
            : $this->getReservationCalendar($search);
        }elseif (Auth::user()->role == 'dosen') {
            $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
            ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        }elseif (Auth::user()->role == 'mahasiswa') {
            $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5);
        }elseif (Auth::user()->role == 'chaplin') {
            $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
            ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        }elseif (Auth::user()->role == 'fungsionaris') {
            $lists = Choose::where('user_id', auth()->id())->where('status', '!=', null)->paginate(5)
            ? $this->getReservationCalendar($search) : $this->getReservationAdminCalendar($search);
        }
        $data = [
        // 'list_pembahasan'=>Pembahasan::all(),
        // 'list_pembahasan'=>Pembahasan::paginate(5),
        // 'list_semester'=>Semester::paginate(5),
        'lists'=> $lists
        ];
        // return view('list.index', compact('lists'));
        return view('calendar.index', compact('lists'), $data);
    }

    public function getReservation($search)
    {
        if($search != ""){
            //return filtered by nip mahasiswa
            return  DB::table('chooses')
            ->join('users','create_user_id','=','users.id')
            ->leftJoin('program_studi','users.nim','=','program_studi.prodi_create_user_id')
            ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','role','users.id as id_users', 'users.status as status_users')
            // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
            ->where('chooses.user_id','=',auth()->id())
            ->where('nim','like',"%$search%")
            ->paginate(5);
        }else{
            // return Choose::where('user_id', auth()->id())->get();
            return  DB::table('chooses')
            ->join('users','user_id','=','users.id')
            ->leftJoin('program_studi','users.nim','=','program_studi.prodi_create_user_id')
            ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','role','users.id as id_users', 'users.status as status_users')
            // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
            ->where('chooses.user_id','=',auth()->id())
            ->where('nim','like',"%$search%")
            ->paginate(5);
        }
    }

    public function getReservationAdmin($search)
    {
        if($search != ""){
            //return filtered by nip mahasiswa
            return  DB::table('chooses')
            ->join('users','create_user_id','=','users.id')
            ->leftJoin('program_studi','users.nim','=','program_studi.prodi_create_user_id')
            ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','role','users.id as id_users', 'users.status as status_users')
            // ->select('chooses.*', 'nama_program_studi', 'program_studi.prodi_create_user_id as prodi_nim','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
            ->where('nim','like',"%$search%")
            ->paginate(5);
        }else{
            // return Choose::all();
            return  DB::table('chooses')
            ->join('users','user_id','=','users.id')
            ->leftJoin('program_studi','chooses.create_user_id','=','program_studi.prodi_create_user_id')
            ->select('chooses.*', 'nama_program_studi','users.nim','name','role','users.id as id_users', 'users.status as status_users')
            //->select('chooses.*', 'nama_program_studi','users.nim','name','email','role','users.id as id_users', 'users.status as status_users')
            ->where('nim','like',"%$search%")
                //->groupBy('id', 'nama_program_studi','users.nim','name','role','id_users', 'status_users')
                ->orderBy('pembahasan')
                ->orderByDesc('datetime')//->get()
            ->paginate(5);
        }
    }

    public function getReservationCalendar($search)
    {
        // return Choose::where('user_id', auth()->id())->get();
        return DB::table('chooses')
        ->join('users','create_user_id','=','users.id')
        ->select('chooses.*','nim','name','role','users.id as id_users', 'users.status as status_users')
        // ->select('chooses.*','nim','name','email','role','users.id as id_users', 'users.status as status_users')
        ->where('chooses.user_id','=',auth()->id())
        ->paginate();
    }

    public function getReservationAdminCalendar($search)
    {
        // return Choose::where('user_id', auth()->id())->get();
        return  DB::table('chooses')
        ->join('users','create_user_id','=','users.id')
        ->select('chooses.*','nim','name','role','users.id as id_users', 'users.status as status_users')->paginate();
        // ->select('chooses.*','nim','name','email','role','users.id as id_users', 'users.status as status_users')->paginate();
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
            return back()->with('success', "Reservasi berhasil ". $request->accept === 'true' ? 'diterima' : 'ditolak' ."!");
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
        $prodi = DB::table('program_studi')->select('nama_program_studi')->where('prodi_create_user_id','=',$choose->create_user_id)->first()->nama_program_studi;

        $jabatan = DB::table('jabatan')->select('jabatan')->where('create_user_id','=',$choose->user_id)->first()->jabatan;

        $choose->prodi = $prodi;
        $choose->jabatan = $jabatan;
        $choose->no_pdf = ChooseController::generateOrderNR($choose->id);

        return view('lihat.index', compact('choose'));
    }

    public function pdf(Choose $choose){
        // echo $choose;
        $choose->no_pdf = ChooseController::generateOrderNR($choose->id);
        $data = $choose->toArray();
        // $pdf = Pdf::loadView('lihat.index', compact('choose'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf = Pdf::loadView('lihat.indexpdf', compact('choose'))->setOptions(['defaultFont' => 'sans-serif']);
        $pdf->setPaper('A4', 'landscape');
        return $pdf->download('invoice.pdf');
    }
    public function daftar_dosen(){
        $dosens = DB::table('users')
            ->select('id', 'name', 'nim')
            ->whereNot('role','=','admin')
            ->WhereNot('role','=','mahasiswa')
            ->paginate(8);

        return view('daftar_dosen.index', compact('dosens'));
    }

    public function jadwalDosen(Request $request){
         $lists = DB::table('chooses')
             ->join('users','create_user_id','=','users.id')
             ->select('chooses.*','nim','name','role','users.id as id_users', 'users.status as status_users')
             // ->select('chooses.*','nim','name','email','role','users.id as id_users', 'users.status as status_users')
             ->where('chooses.user_id','=',$request->id)
             ->paginate();

         $data = [
             // 'list_pembahasan'=>Pembahasan::all(),
             // 'list_pembahasan'=>Pembahasan::paginate(5),
             // 'list_semester'=>Semester::paginate(5),
             'lists'=> $lists
         ];
         // return view('list.index', compact('lists'));
         return view('calendar.index', compact('lists'), $data);
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
