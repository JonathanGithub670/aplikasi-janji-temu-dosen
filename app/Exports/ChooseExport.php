<?php

namespace App\Exports;

use App\Models\Choose;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Illuminate\Support\Facades\Auth;


class ChooseExport implements FromView
{
    // use Exportable;
    protected $histories;
    public function __construct($histories)
    {
        $this->histories = $histories;
    }

    public function view(): View
    {
        $histories = $this->histories;
        $data['histories'] = $histories;
        return view('exports.histories', $data);
    }

     public function getHistories()
     {
     return Choose::where('create_user_id', auth()->id())->where('status', '!=', null)->paginate();
     }

     public function getHistoriesAdmin()
     {
     return Choose::where('status', '!=', null)->paginate();
     }
}
