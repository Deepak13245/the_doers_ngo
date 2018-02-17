<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Interest;
use App\Triats\Maps;
use App\User;
use Illuminate\Http\Request;

class MapController extends Controller
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
        $users = User::all();
        $list = $users;
        /*        foreach ($users as $u) {
                    if ($u->id == $user->id)
                        continue;
                    if (($distance = $this->getMapDistance($ulat, $ulng, $u->lat, $u->lng)) <= $limit) {
                        $list[] = $u;
                        $u->distance = $distance;
                    }
                }*/
        $interest_ids = [];
        $category_ids = [];

        return view('map', compact([ 'user', 'list', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
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
        $users = User::orderBy('id');
        if (!empty($interest_ids))
            $users = $users->whereIn('interest_id', $interest_ids);
        else
            $interest_ids = [];
        if (!empty($category_ids))
            $users = $users->whereIn('category_id', $category_ids);
        else
            $category_ids = [];

        $list = $users->get();
        foreach ($users as $u) {
            if ($u->id == $user->id)
                continue;
            $distance = $this->getMapDistance($ulat, $ulng, $u->lat, $u->lng);
            $u->distance = $distance;
            $list[] = $u;
        }

        return view('map', compact([ 'user', 'list', 'categories', 'interests', 'category_ids', 'interest_ids' ]));
    }
}
