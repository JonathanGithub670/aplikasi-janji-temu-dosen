<?php

namespace App\Http\Controllers;

use App\Models\Choose;
use App\Models\Pembahasan;
use App\Models\Semester;
use App\Models\User;
use App\Models\Image;
use App\Models\Role;
use Carbon\Carbon;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use PHPUnit\Util\Exception;

class ChooseController extends Controller
{
    // public function index()
    // {
    //     $users = User::where('id', '!=', auth()->id())->where('status', 1)->get();
    //     $data = [
    //         'users'=>$users,
    //         'list_pembahasan'=>Pembahasan::all(),
    //     ];
    //     if (Auth::user()->role != 'dosen' || Auth::user()->role != 'admin'){
    //         return view('choose.index', compact('users'));
    //         // return view('choose.index', $data);
    //     }else{
    //         return response()->view('errors.403');
    //     }
    // }
    public function index()
    {
        $users = User::where('users.id', '!=', auth()->id())
            ->join('jabatan','users.id','=','create_user_id')
            ->select(['users.id as id', 'users.name as name', 'jabatan'])
            ->where('status', 1)
            ->whereNot('role','=','admin')
            ->whereNot('role','=','mahasiswa')->get();

        $data = [
            'users'=>$users,
            'list_pembahasan'=>Pembahasan::all(),
            'list_semester'=>Semester::all(),
            // 'roles' => Role::all()
        ];
        // return view('choose.index', compact('users'));
        return view('choose.index', $data);
    }

    private function getFreeTime($work_times)
    {

        $office_start = new DateTime('08:00:00');
        $office_end = new DateTime('18:00:00');

        $free_times = array();

        foreach ($work_times as $work_time) {
            $free_start = $office_start;
            $free_end = $work_time[0]->modify('-1 minute');
            $free_times[] = array($free_start, $free_end);
            $office_start = $work_time[1]->modify('+1 minute');
        }

        $free_times[] = array($office_start, $office_end);

        $split_free_times = array();

        foreach ($free_times as $free_time) {
            $start_time = $free_time[0];
            $end_time = $free_time[1];
            $interval = new DateInterval('PT10M');
            $period = new DatePeriod($start_time, $interval, $end_time);

            foreach ($period as $dt) {
                $split_free_times[] = array(
                    $dt,
                    (clone $dt)->add(new DateInterval('PT9M'))
                );
            }
        }

        $result = array();

        foreach ($split_free_times as $split_free_time) {
            $start_time = $split_free_time[0]->format('H:i');
            $end_time = $split_free_time[1]->format('H:i');
            array_push($result, new FreeTime("$start_time - $end_time", true));
        }

        return $result;
    }

    public function pilihJam(Request $request){
        $schedules = DB::table('routines')
            ->where('user_id','=', $request->queryUserId)
            ->where('hari','=',strtolower($request->queryDay))
            ->get();

        $work_time = array();

        foreach ($schedules as $schedule){
            $task = array(new DateTime($schedule->jam_mulai), new DateTime($schedule->jam_selesai));
            array_push($work_time, $task);
        }

        $booked_schedule = DB::table('time_chooses')
            ->join('chooses','chooses_id','=','chooses.id')
            ->where('chooses.user_id','=',$request->queryUserId)
            ->whereDate('chooses.datetime', $request->queryDate)
            ->get();

        $formated_booked = array();

        foreach ($booked_schedule as $item_booked){
            array_push($formated_booked, substr($item_booked->jam_mulai, 0, -3)." - ".substr($item_booked->jam_selesai, 0, -3));
        }

        $free_time = $this->getFreeTime($work_time);

        foreach($formated_booked as $booked){
            foreach ($free_time as $time) {
                if ($time->time == $booked) {
                    $time->status = false;
                    break;
                }
            }
        }


        return $free_time;
    }

    public function store(Request $request)
    {
        try {
            $jam = explode(" - ",$request->jam);
            $jam_mulai = $jam[0];
            $jam_selesai = $jam[1];

            $date = date_format(date_create_from_format('m-d-Y', $request->date), 'Y-m-d');


            $request->validate([
                'user_id' => 'required|exists:users,id',
                'date' => 'required',
                'pembahasan' => 'required',
                'semester' => 'required',
                'jam'=> 'required',
                'fakeJam'=>'required',
                // 'image' => 'required|image|file|mimes:jpeg,jpg,svg,png|max:1024|dimensions:max_width=800,max_height=800',
                'image' => 'image|file|mimes:jpeg,jpg,svg,png|max:1366|dimensions:max_width=1366,max_height=768',
                'keterangan' => 'required|max:200',
            ]);

            $choose = new Choose();
            $choose->user_id = $request->user_id;
            $choose->create_user_id = auth()->id();
            $choose->datetime = $date;
            $choose->pembahasan = $request->get('pembahasan');
            $choose->semester = $request->get('semester');
            $choose->no_pdf = self::generateOrderNR($choose->id);
            if($request->hasFile('image')){
                $request->file('image')->move('upload-images/',$request->file('image')->getClientOriginalName());
            }
            if($choose->image){
                $choose->image = $request->file('image')->getClientOriginalName();
            }
            $choose->keterangan = $request->get('keterangan');
            $choose->save();

            DB::table('time_chooses')
                ->insert([
                    'chooses_id'=>$choose->id,
                    'jam_mulai'=> $jam_mulai,
                    'jam_selesai'=> $jam_selesai
                ]);

            return redirect()->route('dashboard.choose')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Reservasi berhasil dibuat');
        }catch (\Exception $e){
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Reservasi gagal dibuat.');
        }
    }

    public function getDisabledDate(Request $request){
        $today = Carbon::now()->format('Y-m-d');
        $dateCheck = DB::table('time_chooses')
            ->join('chooses', 'chooses_id','=','chooses.id')
            ->where('chooses.user_id', '=', $request->queryUserId)
            ->whereDate('datetime', '>=', $today)
            ->get()->groupBy('datetime');

        $disabledDate = array();

        foreach ($dateCheck as $items){
            $work_time = array();

            foreach ($items as $schedule){
                $work_time[] = array(new DateTime($schedule->jam_mulai), new DateTime($schedule->jam_selesai));
            }

            if(count($this->getFreeTime($work_time)) == 0){
                $disabledDate[] = date("d-m-Y", strtotime($items[0]->datetime));
            }
        }

        return $disabledDate;
    }


    public function convertInputDateToDateTime($inputDate)
    {
        return Carbon::parse($inputDate)->format('Y-m-d H:i:s');
    }

    public function isUserAvailable($userId)
    {
        $result = DB::table('users')->where('id','=', $userId)->count();
        return $result == 0;
    }


    public static function generateOrderNR($lastNumber)
    {
        return 'FIKOM#' . str_pad((int)$lastNumber, 5, "0", STR_PAD_LEFT);
    }
}
