<?php

namespace App\Http\Livewire;

use App\Http\Controllers\FreeTime;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Support\Facades\DB;
use Livewire\Component;

class PilihJam extends Component
{
    public $data;
    public $showModal = false;
    private function getFreeTime(array $work_times)
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
            $start_time = $split_free_time[0]->format('H:i:s');
            $end_time = $split_free_time[1]->format('H:i:s');
            array_push($result, new FreeTime("$start_time - $end_time", true));
        }

        return $result;
    }

    public function pilihJam(){
        $schedules = DB::table('routines')
            ->where('user_id','=','2')
            ->where('hari','=','senin')
            ->get();

        $work_time = array();

        foreach ($schedules as $schedule){
            $task = array(new DateTime($schedule->jam_mulai), new DateTime($schedule->jam_selesai));
            array_push($work_time, $task);
        }

        $booked_schedule = DB::table('time_chooses')
            ->join('chooses','chooses_id','=','chooses.id')
            ->where('chooses.user_id','=','2')
            ->whereDate('chooses.datetime', '2023-04-24')
            ->get();

        $formated_booked = array();

        foreach ($booked_schedule as $item_booked){
            array_push($formated_booked, "$item_booked->jam_mulai - $item_booked->jam_selesai");
        }

        $free_time = $this->getFreeTime($work_time);

        foreach($formated_booked as $booked){
            foreach ($free_time as $index => $time) {
                if ($time->time == $booked) {
                    $free_time[$index]->status = false;
                    break;
                }
            }
        }

        $this->data = $free_time;
        $this->showModal = true;
    }

    public function render()
    {
        return view('livewire.pilih-jam');
    }
}
