<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileUserController;
use App\Http\Controllers\TableAllController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Auth\AuthenticatedSessionController;
use App\Http\Controllers\Table\TableUserController;
use App\Http\Controllers\TableAdminController;
use App\Http\Controllers\ReferensiController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/profile/my-profile', [ProfileUserController::class, 'show']);

    Route::middleware('can:table_role')->group(function () { 
        //tabel kegiatan
        Route::get('/table-kegiatan', [TableUserController::class, 'index']);
        Route::get('/table-kegiatan/add', [TableUserController::class, 'add']);
        Route::patch('/table-kegiatan/store/tabel', [TableUserController::class, 'storeTabel']);
        Route::get('/table-kegiatan/edit/tabel/{id}', [TableUserController::class, 'edit']);
        Route::patch('/table-kegiatan/update/tabel/{id}', [TableUserController::class, 'update']);
        route::get('table-kegiatan/destroy/tabel/{id}', [TableUserController::class, 'destroy']);

        //undangan
        Route::get('/table-kegiatan/undangan/upload/{id}', [TableUserController::class, 'uploadUndangan']);
        Route::patch('/table-kegiatan/store/undangan/{id}', [TableUserController::class, 'storeUndangan']);
        Route::get('/table-kegiatan/undangan/index/{id}', [TableUserController::class, 'indexUndangan']);
        Route::get('/table-kegiatan/undangan/edit/{id}', [TableUserController::class, 'editUndangan']);
        Route::patch('/table-kegiatan/update/undangan/{id}', [TableUserController::class, 'updateUndangan']);

        //bukti
        Route::get('/table-kegiatan/upload/{id}', [TableUserController::class, 'uploadBukti']);
        Route::patch('/table-kegiatan/store/{id}', [TableUserController::class, 'storeBukti']);
        Route::get('/table-kegiatan/bukti/{id}', [TableUserController::class, 'indexBukti']);
        Route::get('/table-kegiatan/edit/{id}', [TableUserController::class, 'editBukti']);
        Route::patch('/table-kegiatan/update/{id}', [TableUserController::class, 'updateBukti']);

    });

    Route::middleware('can:table_all')->group(function (){
        //tabel kegiatan
        Route::get('/table-kegiatan-all/{table}', [TableAllController::class, 'index']);
        Route::get('/table-kegiatan-all/{table}/add', [TableAllController::class, 'add']);
        Route::patch('/table-kegiatan-all/{table}/store/tabel', [TableAllController::class, 'storeTabel']);
        Route::get('/table-kegiatan-all/{table}/edit/tabel/{id}', [TableAllController::class, 'edit']);
        Route::patch('/table-kegiatan-all/{table}/update/tabel/{id}', [TableAllController::class, 'update']);
        route::get('table-kegiatan-all/{table}/destroy/tabel/{id}', [TableAllController::class, 'destroy']);

        //undangan
        Route::get('/table-kegiatan-all/{table}/undangan/upload/{id}', [TableAllController::class, 'uploadUndangan']);
        Route::patch('/table-kegiatan-all/{table}/store/undangan/{id}', [TableAllController::class, 'storeUndangan']);
        Route::get('/table-kegiatan-all/{table}/undangan/index/{id}', [TableAllController::class, 'indexUndangan']);
        Route::get('/table-kegiatan-all/{table}/undangan/edit/{id}', [TableAllController::class, 'editUndangan']);
        Route::patch('/table-kegiatan-all/{table}/update/undangan/{id}', [TableAllController::class, 'updateUndangan']);

        //bukti
        Route::get('/table-kegiatan-all/{table}/upload/{id}', [TableAllController::class, 'uploadBukti']);
        Route::patch('/table-kegiatan-all/{table}/store/{id}', [TableAllController::class, 'storeBukti']);
        Route::get('/table-kegiatan-all/{table}/bukti/{id}', [TableAllController::class, 'indexBukti']);
        Route::get('/table-kegiatan-all/{table}/edit/{id}', [TableAllController::class, 'editBukti']);
        Route::patch('/table-kegiatan-all/{table}/update/{id}', [TableAllController::class, 'updateBukti']);
    });

    Route::middleware('can:admin')->group(function () { 
        //Table
        Route::get('/table-kegiatan/bagian-umum', [TableAdminController::class, 'umum']);
        Route::get('/table-kegiatan/seksi-bank', [TableAdminController::class, 'bank']);
        Route::get('/table-kegiatan/seksi-mski', [TableAdminController::class, 'mski']);
        Route::get('/table-kegiatan/seksi-pencairan-dana', [TableAdminController::class, 'dana']);
        Route::get('/table-kegiatan/seksi-vera', [TableAdminController::class, 'vera']);

        //Referensi Kegiatan
        Route::get('/referensi/kegiatan', [ReferensiController::class, 'indexKegiatan']);
        Route::get('/referensi/kegiatan/add', [ReferensiController::class, 'addKegiatan']);
        Route::patch('/referensi/kegiatan/store', [ReferensiController::class, 'storeKegiatan']);
        Route::get('/referensi/kegiatan/edit/{id}', [ReferensiController::class, 'editKegiatan']);
        Route::patch('/referensi/kegiatan/update/{id}', [ReferensiController::class, 'updateKegiatan']);
        route::get('/referensi/kegiatan/delete/{id}', [ReferensiController::class, 'destroyKegiatan']);
        //Referensi Pegawai
        Route::get('/referensi/pegawai', [ReferensiController::class, 'indexPegawai']);
        Route::get('/referensi/pegawai/add', [ReferensiController::class, 'addPegawai']);
        Route::patch('/referensi/pegawai/store', [ReferensiController::class, 'storePegawai']);
        Route::get('/referensi/pegawai/edit/{id}', [ReferensiController::class, 'editPegawai']);
        Route::patch('/referensi/pegawai/update/{id}', [ReferensiController::class, 'updatePegawai']);
        route::get('/referensi/pegawai/delete/{id}', [ReferensiController::class, 'destroyPegawai']);
        //user
        Route::get('/user', [UserController::class, 'index']);
        Route::get('/user/add', [UserController::class, 'add']);
        Route::patch('/user/store', [UserController::class, 'store']);
        Route::get('/user/edit/{id}', [UserController::class, 'edit']);
        Route::patch('/user/update/{id}', [UserController::class, 'update']);
        Route::get('/user/delete/{id}', [UserController::class, 'destroy']);
    });

    //menampilkan file
    Route::get('/table-kegiatan/bukti/{id}/{tablename}/{column}', [TableUserController::class, 'showFile']);                              
    Route::get('/table-kegiatan/bukti/{id}/{tablename}/{column}/{idupload}', [TableUserController::class, 'showFileTambahan']);

    //Undangan Dashboard
    Route::get('undangan/{seksi}/{id}', [DashboardController::class, 'undangan']);
});

Route::get('logout', [AuthenticatedSessionController::class, 'destroy']);

require __DIR__.'/auth.php';
