<?php

namespace App\Http\Controllers;

use App\Models\Message;
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
        return
//            $this->checkSession()
//            ?
                $this->showMessagePage()
//            :
//                $this->authorizeUser()
            ;
    }

    public function timeline()
    {
        return view('timeline');
    }

    public function showMessagePage()
    {
        $messages = Message::query()
            ->whereNotNull('content')
            ->orderBy('on')
            ->paginate(1000);
        $lastMessage = Message::query()->whereNotNull('content')->latest()->first();
        return view('messages', compact('messages', 'lastMessage'));
    }
}
