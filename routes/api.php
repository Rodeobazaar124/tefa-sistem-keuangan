<?php

use App\Http\Controllers\Api\AssetController;
use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\LogoutController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\PrintInventaris;
use App\Models\Asset;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::get('inventaris',PrintInventaris::class);

Route::post('/register', RegisterController::class)->name('register');
Route::post('/login', LoginController::class)->name('login');
Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::middleware('auth:api')->post('/logout', LogoutController::class)->name('logout');
Route::middleware('auth:api')->apiResource('/assets', AssetController::class);

Route::get('/laporan/inventaris', function () {
    $tgl_awal = request('tgl_awal');
    $tgl_akhir = request('tgl_akhir');

    if ($tgl_awal && $tgl_akhir) {
        $assets = Asset::whereBetween('created_at', [$tgl_awal, $tgl_akhir])->get();
        $fileName = "Inventaris {$tgl_awal} - {$tgl_akhir}.pdf";
    } else {
        $assets = Asset::all();
        $fileName = "Data Keseluruhan Inventaris.pdf";
    }

    $data = ['assets' => $assets];
    $pdf = Pdf::loadView('print.inventaris', $data);

    return $pdf->stream($fileName);
})->name('laporan.inventaris');
