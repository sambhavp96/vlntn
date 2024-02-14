<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Hash;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    public function checkSession()
    {
        $matchingHash = '$2y$12$sqnwgscn/6ecXYPOf4VqbeXtp69aDNcsXtQ/MYKSbgpdexnlqkvbu';
        return session()->has('password') && session()->get('password') === $matchingHash;
    }

    public function authorizeUser()
    {
        return view('password');
    }
}
