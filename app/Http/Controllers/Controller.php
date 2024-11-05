<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;

abstract class Controller
{
    public function __construct()
    {
        if(Auth::check())
        {
            if(!checkPermission()) {
                abort(403, 'Unauthorized action.');
            }
        }
    }
}
