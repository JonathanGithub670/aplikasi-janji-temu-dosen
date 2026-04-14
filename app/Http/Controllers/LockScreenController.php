<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class LockScreenController extends Controller
{
    public function index(): View
    {
        return view('lock-screen.index', ['title' => 'Lock Screen']);
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): RedirectResponse
    {
        Auth::logout();
        request()->session()->invalidate();
        request()->session();
        return redirect('dashboard.lock-screen');
    }

    public function show(int $id): void
    {
        //
    }

    public function edit(int $id): void
    {
        //
    }

    public function update(Request $request, int $id): void
    {
        //
    }

    public function destroy(int $id): void
    {
        //
    }
}
