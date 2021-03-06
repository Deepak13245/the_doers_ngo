<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Interest;
use App\User;
use Auth;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @param Request $request
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $user = $request->user();
        $categories = Category::all();
        $interests = Interest::all();
        $users = User::orderByDesc('id')->with([ 'interest', 'category' ])->paginate(5);
        $interest_ids = [];
        $category_ids = [];
        $paginate = true;
        return view('home', compact([ 'user', 'users', 'categories', 'interests', 'category_ids', 'interest_ids', 'paginate' ]));
    }

    public function filter(Request $request)
    {
        if (empty($request->get('category')) && empty($request->get('interest')))
            return redirect()->to('/home');
        $interest_ids = $request->get('interest');
        $category_ids = $request->get('category');
        $user = $request->user();
        $categories = Category::all();
        $interests = Interest::all();
        $users = User::orderByDesc('id');
        if (!empty($interest_ids))
            $users = $users->whereIn('interest_id', $interest_ids);
        else
            $interest_ids = [];
        if (!empty($category_ids))
            $users = $users->whereIn('category_id', $category_ids);
        else
            $category_ids = [];
        $paginate = false;
        $users = $users->with([ 'interest', 'category' ])->get();
        return view('home', compact([ 'user', 'users', 'categories', 'interests', 'category_ids', 'interest_ids', 'paginate' ]));
    }

    function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to('/auth')->with([ 'type' => 'info', 'message' => 'Logged out' ]);
    }


}
