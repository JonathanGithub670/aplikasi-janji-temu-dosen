<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\View\View;

class ErrorsController extends Controller
{
    public function index(): View
    {
        return view('errors.404');
    }

    public function create(): void
    {
        //
    }

    public function store(Request $request): void
    {
        //
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
