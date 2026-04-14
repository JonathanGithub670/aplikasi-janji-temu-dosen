<?php

use App\Http\Controllers\RoutinesController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\CalendarController;
use App\Http\Controllers\ChooseController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\ListController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\VerificationController;
use App\Http\Controllers\TopsisController;
use App\Http\Controllers\HasilController;
use Illuminate\Support\Facades\Auth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::middleware('guest')->group(function () {
    Route::get('/', function () {
        return view('login.index2',[
            "title"=>'Home',
        ]);
    })->name('login');

    Route::post('/', [LoginController::class, 'authenticate']);
    // Route::post('/recover',[LoginController::class, 'recoverpw'])->name('recoverpw');

    // Route::get('/register', [RegisterController::class, 'index'])->name('register');

    // Route::post('/register', [RegisterController::class, 'store']);
});

Route::middleware('auth')->group(function () {
    Route::post('/logout', [LoginController::class, 'logout'])->name('logout');


    Route::prefix('dashboard')->group(function () {

        Route::middleware('role:admin')->group(function () {
            Route::post('/recover',[LoginController::class, 'recoverpw'])->name('recoverpw');
            Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
            Route::get('/register', [RegisterController::class, 'index'])->name('register');
            Route::post('/register', [RegisterController::class, 'store']);
            Route::get('excel',[HistoryController::class, 'export'])->name('dashboard.history.export');

            // Route::get('daftar_dosen',[ListController::class, 'daftar_dosen'])->name('dashboard.daftar_dosen');
            // Route::get('jadwal_dosen',[ListController::class, 'jadwal_dosen'])->name('dashboard.jadwal_dosen');
            // Route::get('alternatif',[TopsisController::class, 'alternatif'])->name('dashboard.topsis.alternatif');

            // Route::post('ubah', [VerificationController::class, 'changepassword'])->name('dashboard.verification.ubahpassword');

            // Route::get('coba',[CobaCobaController::class, 'index'])->name('dashboard.coba');

            // Route::post('lock-screen', [LockScreenController::class, 'store'])->name('dashboard.lock-screen');
            // Route::post('lock-screen', [LoginController::class, 'authenticate']);
            // Route::get('lock-screen', [LoginController::class, 'lockScreen'])->name('dashboard.lock-screen');
            // Route::get('lock-screen', [LockScreenController::class, 'index']);

        });
        Route::middleware('role:mahasiswa')->group(function () {
            // Route::get('/', [DashboardController::class, 'lockScreen'])->name('dashboard.lock-screen');
            Route::get('choose',[ChooseController::class, 'index'])->name('dashboard.choose');
            Route::post('choose',[ChooseController::class, 'store'])->name('dashboard.choose.store');
            Route::get('history',[HistoryController::class, 'index'])->name('dashboard.history');
            Route::get('history/{history}/delete',[HistoryController::class,
            'destroy'])->name('dashboard.history-destroy');
            // Route::get('list',[ListController::class, 'index'])->name('dashboard.list');
            // Route::post('',[CalendarController::class,'index']);

        });
        Route::middleware('role:admin,mahasiswa')->group(function () {
            Route::get('daftar_dosen',[ListController::class, 'daftar_dosen'])->name('dashboard.daftar_dosen');
            // Route::get('jadwal_dosen',[ListController::class, 'jadwal_dosen'])->name('dashboard.jadwal_dosen');

        });

        Route::middleware('role:admin')->group(function () {
            Route::get('routines',[RoutinesController::class, 'index'])->name('dashboard.routines');
            Route::get('routines-detail/{id}',[RoutinesController::class, 'detail'])->name('dashboard.routines.detail');
        });


        Route::middleware('role:admin,dosen,chaplin,fungsionaris')->group(function () {
            Route::get('routines-dosen/',[RoutinesController::class, 'detail_dosen'])->name('dashboard.routines.detail.dosen');
            Route::get('off-create/{id?}',[RoutinesController::class, 'off_create'])->name('dashboard.off.create');
            Route::post('off-store',[RoutinesController::class, 'off_store'])->name('dashboard.off.store');
            Route::get('off/{id}',[RoutinesController::class, 'off'])->name('dashboard.off');
            Route::post('off-edit',[RoutinesController::class, 'off_edit'])->name('dashboard.off.edit');
            Route::get('off-delete/{id}',[RoutinesController::class, 'off_delete'])->name('dashboard.off.delete');
            Route::get('calendar',[ListController::class,'calendar'])->name('dashboard.calendar');
            // Route::get('list',[ListController::class, 'index'])->name('dashboard.list');
            Route::get('list',[ListController::class, 'index'])->name('dashboard.list');
            Route::get('{id}/acc', [ListController::class, 'acceptance'])->name('dashboard.list-accepttance');
            Route::get('list/{choose}/delete', [ListController::class, 'destroy'])->name('dashboard.list-destroy');
            // Route::get('list/{choose}', [ListController::class, 'lihat'])->name('dashboard.list-lihat');
            // Route::get('history',[HistoryController::class, 'index'])->name('dashboard.history');
            // Route::get('history/{history}/delete',[HistoryController::class, 'destroy'])->name('dashboard.history-destroy');

            // Route::get('pdf',[HistoryController::class, 'pdf'])->name('dashboard.history.pdf');
            // Route::get('pdf',[ListController::class, 'pdf'])->name('dashboard.list.pdf');

            // Route::get('errors',[ErrorsController::class, 'index'])->name('dashboard.errors');
            // Route::get('errors',[ErrorsController::class, 'store']);
            Route::post('routines-store',[RoutinesController::class, 'store'])->name('dashboard.routines.store');
            Route::post('routines-edit',[RoutinesController::class, 'edit'])->name('dashboard.routines.edit');
            Route::get('routines-delete/{id}',[RoutinesController::class, 'delete'])->name('dashboard.routines.delete');
            Route::post('routines-perkuliahan',[RoutinesController::class, 'perkuliahan'])->name('dashboard.routines.perkuliahan');
            Route::get('TOPSIS',[TopsisController::class, 'index'])->name('dashboard.topsis');
            Route::POST('/kriteria/create', [TopsisController::class, 'create'])->name('kriteria.create');
            Route::get('/kriteria/edit/{kode}', [TopsisController::class, 'edit'])->name('kriteria.edit');
            Route::put('/kriteria/edit/{kode}', [TopsisController::class, 'update'])->name('kriteria.update');
            Route::delete('/kriteria/hapus/{kode}', [TopsisController::class, 'destroy'])->name('kriteria.destroy');

            Route::POST('/alternatif/create', [TopsisController::class, 'createalternatif'])->name('alternatif.create');
            Route::get('/alternatif/edit/{kode}', [TopsisController::class, 'alternatifedit'])->name('alternatif.edit');
            Route::put('/alternatif/edit/{kode}', [TopsisController::class, 'alternatifupdate'])->name('alternatif.update');
            Route::POST('/alternatif/penilaian/', [TopsisController::class, 'alternatifinsertpenilaian'])->name('alternatif.penilaian');
            Route::delete('/alternatif/hapus/{kode}', [TopsisController::class, 'destroyalternatif'])->name('alternatif.destroy');

            Route::get('/hasil', [HasilController::class, 'index'])->name('hasil');
        });

        Route::middleware('role:admin,dosen,mahasiswa,chaplin,fungsionaris')->group(function () {
            Route::get('list/{choose}', [ListController::class, 'lihat'])->name('dashboard.list-lihat');
            Route::get('calendar/{id}',[ListController::class,'jadwalDosen'])->name('dashboard.jadwal-dosen');
            Route::get('getDisableData', [ChooseController::class, 'getDisabledDate']);
            Route::get('pilihJam', [ChooseController::class, 'pilihJam']);
            Route::get('pilihJamOff', [ChooseController::class, 'pilihJamOff']);

        });

        Route::middleware('role:admin,dosen,mahasiswa')->group(function () {
            Route::get('history',[HistoryController::class, 'index'])->name('dashboard.history');
            Route::get('history/{history}/delete',[HistoryController::class,
            'destroy'])->name('dashboard.history-destroy');
            // Route::get('list/{choose}', [ListController::class, 'lihat'])->name('dashboard.list-lihat');
            Route::get('pdf/{choose}',[ListController::class, 'pdf'])->name('dashboard.list-pdf');
        });

        Route::middleware('role:admin')->prefix('verification')->group(function () {
            Route::get('/', [VerificationController::class, 'index'])->name('dashboard.verification.index');
            Route::get('{user}/acc', [VerificationController::class, 'acceptance'])->name('dashboard.verification.accepttance');
            Route::post('ubah', [VerificationController::class, 'changepassword'])->name('dashboard.verification.ubahpassword');

        });
    });
});


// Route::get('/', [LoginController::class, 'index'])->name('login')->middleware('guest');

// Route::resource('/dashboard/posts', DashboardPostController::class)->middleware('auth');

// Route::post('/register', [RegisterController::class, 'store']);


// Route::get('/categories/{category:slug}', function (Category $category){
//     return view ('posts',[
//         'title' => "Post by Category : $category->name",
//         'posts' => $category->posts->load('category','author'),
//     ]);
// });

// Route::get('/authors/{author:username}', function(User $author){
//     return view ('posts',[
//         'title' => "Post by Author : $author->name",
//         'posts' => $author->posts->load('category','author'),
//     ]);
// });
