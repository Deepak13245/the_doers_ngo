<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Event;
use App\Models\Interest;
use App\Triats\Maps;
use Illuminate\Http\Request;

class EventMapController extends Controller
{
    use Maps;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }


    function index(Request $request)
    {
        $limit = $request->get('radius', 15);
        $user = $request->user();
        $categories = Category::all();
        $interests = Interest::all();
        $ulat = $user->lat;
        $ulng = $user->lng;
        $events = Event::all();
        $list = $events;
        $interest_ids = [];
        $category_ids = [];

        return view('map.event', compact([ 'user', 'list', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
    }

    function filter(Request $request)
    {
        $limit = $request->get('radius', 15);
        $user = $request->user();
        $categories = Category::all();
        $interests = Interest::all();
        $interest_ids = $request->get('interest');
        $category_ids = $request->get('category');
        $ulat = $user->lat;
        $ulng = $user->lng;
        $events = Event::orderBy('id');
        if (!empty($interest_ids))
            $events = $events->whereIn('interest_id', $interest_ids);
        else
            $interest_ids = [];
        if (!empty($category_ids))
            $events = $events->whereIn('category_id', $category_ids);
        else
            $category_ids = [];

        $list = $events->get();

        return view('map.event', compact([ 'user', 'list', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
    }
}
