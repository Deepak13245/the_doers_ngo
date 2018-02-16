<?php

namespace App\Http\Controllers;

use App\Http\Requests\RegisterRequest;
use App\Models\Category;
use App\Models\Interest;
use App\User;
use Exception;
use Hash;

class GuestController extends Controller
{

    public function auth()
    {
        if (\Auth::check())
            return redirect()->to('home');
        $categories = Category::all();
        $interests = Interest::all();
        return view('auth', compact([ 'interests', 'categories' ]));
    }

    public function register(RegisterRequest $request)
    {
        $data = $request->validated();
        $data['password'] = Hash::make($data['password']);
        try {
            $user = User::create($data);
            return redirect()->back()->with([ 'message' => 'Registration successful', 'type' => 'success' ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([ 'Error' => $e->getMessage() ]);
        }
    }
}
