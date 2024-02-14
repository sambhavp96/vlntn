<?php

namespace App\Http\Controllers;

use App\Models\Message;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class PageController extends Controller
{
    public function index()
    {
        return
            $this->checkSession()
                ?
                view('welcome')
                :
                $this->authorizeUser()
            ;
    }
    public function messages()
    {
        return
            $this->checkSession()
            ?
                $this->showMessagePage()
            :
                $this->authorizeUser()
            ;
    }

    public function timeline()
    {
        return
            $this->checkSession()
                ?
                view('timeline')
                :
                $this->authorizeUser()
            ;
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

    public function authenticate(Request $request)
    {
        $request->validate([
            'password' => 'required|string'
        ]);
        $password = $request->get('password');
        $matchingHash = '$2y$12$sqnwgscn/6ecXYPOf4VqbeXtp69aDNcsXtQ/MYKSbgpdexnlqkvbu';

        if (!Hash::check($password, $matchingHash))
        {
            return view('password')->with('error', 'Invalid password');
        }

        session()->put('password', $matchingHash);
        return redirect()->to(url()->previous());
    }
}
