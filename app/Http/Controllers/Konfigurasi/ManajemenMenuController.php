<?php

namespace App\Http\Controllers\Konfigurasi;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ManajemenMenuController extends Controller
{
    public $title = 'Manajemen Menu';

    public function index()
    {
        $menus = DB::table('menu_modul')->select('id', 'kode_modul', 'nama_modul')->orderBy('key')->get();
        dd($menus);
        return view('pages.konfigurasi.menus.index', [
            'title' => $this->title,
            'menus' => $menus
        ]);
    }
}
