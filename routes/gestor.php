<?php

use Illuminate\Support\Facades\Route;
use App\Http\Livewire\GestorRrhh;
use App\Http\Livewire\Gestor\MasterCrea;
use App\Http\Livewire\GestorTrabajos\Trabajos;



/* Route::get('gestor/master',MasterCrea::class)->name('master.crea');
Route::redirect('gestor','gestor.partes'); */
Route::group(['middleware' => ['role:GestorRRHH']], function () {
    /* Route::get('partes',GestorRrhh::class)->name('gestor.partes.index');
    Route::get('master',MasterCrea::class)->name('master.crea'); */
    Route::get('catalogoTrabajos',Trabajos::class)->name('catalogo.trabajos');
});


