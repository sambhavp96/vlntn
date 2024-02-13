<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Http\Request;

class PageController extends Controller
{
    public function index()
    {
        return view('welcome');
    }
    public function messages()
    {
        return $this->checkSession()
            ? view('messages')
            : $this->authorizeUser();
    }

    public function timeline()
    {
        return view('timeline');
    }
}
