<?php

namespace App\Http\Controllers\API;

use App\Model\Event;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Spark\Contracts\Repositories\NotificationRepository;

class EventController extends Controller
{
    /** @var NotificationRepository */
    private $notifications;

    /**
     * Create a new controller instance.
     *
     * @param NotificationRepository $notifications
     */
    public function __construct(NotificationRepository $notifications)
    {
        $this->notifications = $notifications;
    }

    /**
     * Get all of the events.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(Request $request)
    {
        /** @var User $user */
        $user = $request->user();
        $results = Event::where('team_id', '=', $user->currentTeam()->id)
            ->orderBy('open_date_time', 'desc')
            ->paginate(20);
        return $results;
    }

    /**
     * @param Request $request
     * @param Event $event
     * @return Event
     */
    public function fetch(Request $request, Event $event)
    {
        return $event;
    }

    public function put(Request $request, Event $event)
    {
        $inputs = $this->sanitize($request->all());

        $rules = [
            'type' => 'required',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'location_name' => 'required|max:255',
            'location_address' => 'required|max:255',
            'contact_name' => 'required|max:255',
            'contact_phone' => 'required|max:255',
            'open_date_time' => 'required|max:255',
            'drawing_date_time' => 'required|max:255',
            'terms_and_conditions' => 'required|max:2000',
        ];

        $validator = \Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return \Response::json(
                $validator->errors(),
                422
            );
        }

        $event->type = $inputs['type'];
        $event->name = $inputs['name'];
        $event->description = $inputs['description'];
        $event->location_name = $inputs['location_name'];
        $event->location_address = $inputs['location_address'];
        $event->contact_name = $inputs['contact_name'];
        $event->contact_phone = $inputs['contact_phone'];
        $event->open_date_time = $inputs['open_date_time'];
        $event->drawing_date_time = $inputs['drawing_date_time'];
        $event->terms_and_conditions = $inputs['terms_and_conditions'];
        $event->save();
        return response()->json(['success' => true]);
    }
}
