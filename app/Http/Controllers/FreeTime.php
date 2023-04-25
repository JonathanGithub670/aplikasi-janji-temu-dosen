<?php

namespace App\Http\Controllers;

class FreeTime
{
    public $time;
    public $status;

    public function __construct(string $time, bool $status)
    {
        $this->time = $time;
        $this->status = $status;
    }
}
