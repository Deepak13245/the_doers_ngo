<?php

namespace App\Http\Controllers;

use App\Http\Requests\EventRequest;
use App\Models\Category;
use App\Models\Event;
use App\Models\Interest;
use App\Triats\Maps;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\Request;

class EventController extends Controller
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
        $events = Event::orderBy('start')->with([ 'interest', 'category', 'user' ])->paginate(5);
        $interest_ids = [];
        $category_ids = [];
        $paginate = true;
        return view('event', compact([ 'user', 'events', 'categories', 'interests', 'category_ids', 'interest_ids', 'paginate' ]));
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
        $events = Event::orderBy('start');
        if (!empty($interest_ids))
            $events = $events->whereIn('interest_id', $interest_ids);
        else
            $interest_ids = [];
        if (!empty($category_ids))
            $events = $events->whereIn('category_id', $category_ids);
        else
            $category_ids = [];
        $events = $events->with([ 'interest', 'category', 'user' ])->get();
        $paginate = false;
        return view('event', compact([ 'user', 'events', 'categories', 'interests', 'category_ids', 'interest_ids', 'paginate' ]));
    }

    function event(EventRequest $request)
    {
        try {
            $data = $request->all();
            $user = $request->user();
            $data['user_id'] = $user->id;
            $location = $this->getMapLL($data['address']);
            $data['lat'] = $location->lat;
            $data['lng'] = $location->lng;
            $data['start'] = Carbon::createFromFormat('d-m-Y H:i', $data['start']);
            $data['end'] = Carbon::createFromFormat('d-m-Y H:i', $data['end']);
            $event = Event::create($data);
            return redirect()->back()->with([ 'type' => 'success', 'message' => 'Event is posted' ]);
        } catch (Exception $e) {
            return redirect()->back()->withErrors([ 'Error' => $e->getMessage() ]);
        }
    }

    function deleteEvent(Request $request, Event $event)
    {
        if ($event->user_id == $request->user()->id)
            $event->delete();
        return redirect()->back()->with([ 'type' => 'info', 'message' => 'Event Deleted' ]);
    }
}
