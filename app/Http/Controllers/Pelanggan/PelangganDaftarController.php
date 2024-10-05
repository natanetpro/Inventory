<?php

namespace App\Http\Controllers\Pelanggan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PelangganDaftarController 
{
    public $title = 'Pelanggan';

    public function index(Request $request)
    {
        
        return view('pages.daftar.pelanggan.index', ['title' => $this->title]);
    }

    
}
