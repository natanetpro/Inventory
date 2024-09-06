<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenMenuController extends Controller
{
    public function index()
    {
        $moduls = DB::raw('SELECT * FROM module_menus');
        return view('pages.konfigurasi.modul.index', [
            'moduls' => $moduls
        ]);
    }
}
