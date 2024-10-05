<?php

namespace App\Http\Controllers\Daftar;
use App\Http\Controllers\Controller;
//use Exception;
use Illuminate\Http\Request;
//use Illuminate\Support\Facades\DB;

class SupplierDaftarController extends Controller
{
    public $title = 'Daftar Supplier';

    public function index()
    {
        
        return view('pages.daftar.supplier.index', ['title' => $this->title]);
    }

    
}
