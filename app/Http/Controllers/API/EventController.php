<?php

namespace App\Http\Controllers\API;

use App\Model\Event;
use App\Team;
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
        $this->middleware('auth:api');
        $this->notifications = $notifications;
    }

    /**
     * Set the user and team inherent in the current request
     * @param Request $request
     * @return void
     */
    protected function init(Request $request)
    {
        /** @var User $user */
        $this->user = $request->user();
        /** @var Team $currentTeam */
        $this->team = $this->user->currentTeam();
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

}
