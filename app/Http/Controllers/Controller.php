<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function checkSession()
    {
        return session()->has('first-meet') && Carbon::make(session()->get('first-meet'))->isSameDay(Carbon::make('2023-07-28'));
    }

    public function authorizeUser()
    {
        return view('authorize');
    }
}
