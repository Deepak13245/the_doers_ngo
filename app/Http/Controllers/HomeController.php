<?php

namespace App\Http\Controllers;

use App\Http\Requests\PostRequest;
use App\Models\Category;
use App\Models\Interest;
use App\Models\Post;
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
        $posts = Post::orderByDesc('id')->with([ 'interest', 'category', 'user' ])->paginate(5);
        $interest_ids = [];
        $category_ids = [];
        return view('home', compact([ 'user', 'posts', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
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
        $posts = Post::orderByDesc('id');
        if (!empty($interest_ids))
            $posts = $posts->whereIn('interest_id', $interest_ids);
        else
            $interest_ids = [];
        if (!empty($category_ids))
            $posts = $posts->whereIn('category_id', $category_ids);
        else
            $category_ids = [];
        $posts = $posts->with([ 'interest', 'category', 'user' ]);//->paginate(5)
        return view('home', compact([ 'user', 'posts', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
    }

    function post(PostRequest $request)
    {
        $data = $request->all();
        $user = $request->user();
        $data['user_id'] = $user->id;
        $post = Post::create($data);
        return redirect()->back()->with([ 'type' => 'success', 'message' => 'Posted' ]);
    }

    function deletePost(Request $request, Post $post)
    {
        if ($post->user_id == $request->user()->id)
            $post->delete();
        return redirect()->back()->with([ 'type' => 'info', 'message' => 'Post Deleted' ]);
    }

    function logout(Request $request)
    {
        Auth::logout();
        return redirect()->to('/auth')->with([ 'type' => 'info', 'message' => 'Logged out' ]);
    }


}
