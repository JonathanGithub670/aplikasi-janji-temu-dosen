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
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;
use Exception;

class ChooseController extends Controller
{
    public function index(): View
    {
        $users = User::where('users.id', '!=', auth()->id())
            ->leftJoin('jabatan', 'users.id', '=', 'jabatan.create_user_id')
            ->select(['users.id as id', 'users.name as name', 'jabatan'])
            ->where('status', 1)
            ->whereNot('role', '=', 'admin')
            ->whereNot('role', '=', 'mahasiswa')->get();

        $data = [
            'users' => $users,
            'list_pembahasan' => Pembahasan::all(),
            'list_semester' => Semester::all(),
        ];
        return view('choose.index', $data);
    }

    private function getFreeTime(array $work_times, mixed $id, string $date): array
    {
        $office_start = new DateTime('08:00:00');
        $office_end = new DateTime('18:00:00');

        $free_times = [];

        foreach ($work_times as $work_time) {
            $free_start = $office_start;
            $free_end = $work_time[0]->modify('-1 minute');
            $free_times[] = [$free_start, $free_end];
            $office_start = $work_time[1]->modify('+1 minute');
        }

        $free_times[] = [$office_start, $office_end];

        $split_free_times = [];

        foreach ($free_times as $free_time) {
            $start_time = $free_time[0];
            $end_time = $free_time[1];
            $interval = new DateInterval('PT15M');
            $period = new DatePeriod($start_time, $interval, $end_time);

            foreach ($period as $dt) {
                $split_free_times[] = [
                    $dt,
                    (clone $dt)->add(new DateInterval('PT14M'))
                ];
            }
        }

        $result = [];

        $off_times = DB::table('off_time')
            ->where('user_id', '=', $id)
            ->where('tanggal', '=', $date)
            ->get();

        $off_time_checks = [];

        foreach ($off_times as $off_time) {
            $off_time_checks[] = $off_time->jam_mulai;
        }

        foreach ($split_free_times as $split_free_time) {
            if (in_array($split_free_time[0]->format('H:i:s'), $off_time_checks)) {
                continue;
            }
            $start_time = $split_free_time[0]->format('H:i');
            $end_time = $split_free_time[1]->format('H:i');
            $result[] = new FreeTime("$start_time - $end_time", true);
        }

        return $result;
    }

    public function pilihJam(Request $request): array
    {
        $routines = DB::table('routines')
            ->where('user_id', '=', $request->queryUserId)
            ->where('hari', '=', $request->queryDay)
            ->get();

        $work_time = [];

        foreach ($routines as $routine) {
            $task = [new DateTime($routine->jam_mulai), new DateTime($routine->jam_selesai)];
            $work_time[] = $task;
        }

        $booked_schedule = DB::table('time_chooses')
            ->join('chooses', 'chooses_id', '=', 'chooses.id')
            ->where('chooses.user_id', '=', 2)
            ->whereDate('chooses.date', '2023-05-30')
            ->get();

        $formated_booked = [];

        foreach ($booked_schedule as $item_booked) {
            $formated_booked[] = substr($item_booked->jam_mulai, 0, -3) . " - " . substr($item_booked->jam_selesai, 0, -3);
        }

        $free_time = $this->getFreeTime($work_time, $request->queryUserId, $request->queryDate);

        foreach ($formated_booked as $booked) {
            foreach ($free_time as $time) {
                if ($time->time == $booked) {
                    $time->status = false;
                    break;
                }
            }
        }

        return $free_time;
    }

    public function pilihJamOff(Request $request): array
    {
        $routines = DB::table('routines')
            ->where('user_id', '=', $request->queryUserId)
            ->where('hari', '=', $request->queryDay)
            ->get();

        $work_time = [];

        foreach ($routines as $routine) {
            $task = [new DateTime($routine->jam_mulai), new DateTime($routine->jam_selesai)];
            $work_time[] = $task;
        }

        $booked_schedule = DB::table('time_chooses')
            ->join('chooses', 'chooses_id', '=', 'chooses.id')
            ->where('chooses.user_id', '=', 2)
            ->whereDate('chooses.date', '2023-05-30')
            ->get();

        $formated_booked = [];

        foreach ($booked_schedule as $item_booked) {
            $formated_booked[] = substr($item_booked->jam_mulai, 0, -3) . " - " . substr($item_booked->jam_selesai, 0, -3);
        }

        $free_time = $this->getFreeTime($work_time, $request->queryUserId, $request->queryDate);

        return $free_time;
    }

    public function store(Request $request): RedirectResponse|Exception
    {
        try {
            $request->validate([
                'user_id' => 'required|exists:users,id',
                'date' => 'required',
                'pembahasan' => 'required',
                'semester' => 'required|exists:semester,id',
                'jam' => 'required|regex:/^\d{2}:\d{2} - \d{2}:\d{2}$/',
                'fakeJam' => 'required',
                'image' => 'nullable|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:2048',
                'keterangan' => 'required|max:200',
            ]);

            $jam = explode(" - ", $request->jam);
            $jam_mulai = $jam[0];
            $jam_selesai = $jam[1];

            $date = date_format(date_create_from_format('m-d-Y', $request->date), 'Y-m-d');

            $choose = new Choose();
            $choose->user_id = $request->user_id;
            $choose->create_user_id = auth()->id();
            $choose->date = $date;
            $choose->pembahasan = $request->get('pembahasan');
            $choose->semester = $request->get('semester');
            $choose->no_pdf = self::generateOrderNR($choose->id);
            if ($request->hasFile('image')) {
                $request->file('image')->move('upload-images/', $request->file('image')->getClientOriginalName());
                $choose->image = $request->file('image')->getClientOriginalName();
            }
            $choose->keterangan = $request->get('keterangan');
            $choose->save();

            DB::table('time_chooses')
                ->insert([
                    'chooses_id' => $choose->id,
                    'jam_mulai' => $jam_mulai,
                    'jam_selesai' => $jam_selesai
                ]);

            $ide_pembahasan = DB::table('pembahasan')->where('id', '=', $choose->pembahasan)->first()->ide_pembahasan;

            DB::table('chooses_alternatif')
                ->insert([
                    'chooses_id' => $choose->id,
                    'alternatif_id' => DB::table('alternatif')->where('nama_alternatif', '=', $ide_pembahasan)->first()->id_alternatif
                ]);

            return redirect()->route('dashboard.choose')
                ->with('alert_type', 'success')
                ->with('alert_message', 'Reservasi berhasil dibuat');
        } catch (\Exception $e) {
            return $e;
            return redirect()->back()
                ->with('alert_type', 'danger')
                ->with('alert_message', 'Reservasi gagal dibuat.');
        }
    }

    public function getDisabledDate(Request $request): array
    {
        $today = Carbon::now()->format('Y-m-d');

        $dateCheck = DB::table('time_chooses')
            ->join('chooses', 'chooses_id', '=', 'chooses.id')
            ->where('chooses.user_id', '=', $request->queryUserId)
            ->whereDate('date', '>=', $today)
            ->get()->groupBy('date');

        $disabledDate = [];

        foreach ($dateCheck as $items) {
            $work_time = [];

            foreach ($items as $schedule) {
                $work_time[] = [new DateTime($schedule->jam_mulai), new DateTime($schedule->jam_selesai)];
            }

            if (count($this->getFreeTime($work_time, $request->queryUserId, $today)) == 0) {
                $disabledDate[] = date("d-m-Y", strtotime($items[0]->date));
            }
        }

        return $disabledDate;
    }

    public function convertInputDateToDateTime(string $inputDate): string
    {
        return Carbon::parse($inputDate)->format('Y-m-d H:i:s');
    }

    public function isUserAvailable(int $userId): bool
    {
        $result = DB::table('users')->where('id', '=', $userId)->count();
        return $result == 0;
    }

    public static function generateOrderNR(mixed $lastNumber): string
    {
        return 'FIKOM#' . str_pad((int) $lastNumber, 5, "0", STR_PAD_LEFT);
    }
}
