<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

function checkPermission()
{
    // hilangkan / di awal
    $url = ltrim($_SERVER['REQUEST_URI'], '/');
    // get DB
    $modul = DB::table('menu_modul')->where('nama_url', $url)->first();
    $userLevel = Auth::user()->level;

    if(!strpos($modul->textlevel, (string) $userLevel))
    {
        return false;
    }
    return true;
}

?>