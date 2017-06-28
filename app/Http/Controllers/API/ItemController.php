<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\Items\ItemImageRequest;
use App\Model\Event;
use App\Model\Item;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Laravel\Spark\Contracts\Repositories\NotificationRepository;

class ItemController extends Controller
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

        \Validator::extend('itemImage',
            function ($attribute, $value, $parameters, $validator) {
                $item_id = $parameters[0];
                if (!preg_match("/items\/{$item_id}\//", $value)) {
                    return false;
                }
                if (empty(config('filesystems.disks.s3.key')) || config('filesystems.default') == 'local') {
                    $disk = 'public';
                } else {
                    $disk = 's3';
                }
                if (!\Storage::disk($disk)->exists($value)) {
                    return false;
                }
                return true;
            },
            ':attribute is an invalid item photo'
        );
    }

    /**
     * The validation rules for saving an item.
     * @return array
     */
    protected function rules()
    {
        return [
            'type' => 'required',
            'name' => 'required|max:255',
            'description' => 'required|max:255',
            'image' => 'required|max:255',
            'value' => 'required|numeric',
            'cost' => 'required|numeric',
            'sponsor' => 'required|max:255',
        ];
    }

    /**
     * Get all of the items.
     *
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     */
    public function all(Request $request, Event $event)
    {
        $results = Item::where('event_id', '=', $event->id)
            ->paginate(20);
        return $results;
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function fetch(Request $request, Item $item)
    {
        return response()->json($item);
    }

    /**
     * @param Request $request
     * @param Item $item
     * @return \Illuminate\Http\JsonResponse
     */
    public function put(Request $request, Item $item)
    {
        $inputs = $this->sanitize($request->all());

        // since a put can update any value, then run the validation for any field that's passed in
        $rules = array_intersect_key($this->rules(), $inputs);
        if (!empty($rules['image'])) {
            $rules['image'] .= "|itemImage:{$item->id}";
        }

        $validator = \Validator::make($inputs, $rules);

        if ($validator->fails()) {
            return \Response::json(
                $validator->errors(),
                422
            );
        }

        $item->type = $inputs['type'];
        $item->name = $inputs['name'];
        $item->description = $inputs['description'];
        $item->image = $inputs['image'];
        $item->value = $inputs['value'];
        $item->cost = $inputs['cost'];
        $item->sponsor = $inputs['sponsor'];
        $item->save();
        return response()->json(['success' => true]);
    }

    /**
     * Upload a document for an order
     *
     * @param  ItemImageRequest $request
     * @param  Item $item
     * @return \Response
     */
    public function upload(ItemImageRequest $request, Item $item)
    {
        $file = $request->file('file');
        if (empty(config('filesystems.disks.s3.key')) || config('filesystems.default') == 'local') {
            // Just using Filesystem here
            $target = $file->store("items/{$item->id}", 'public');
        } else {
            // using S3 Storage here
            $target = $file->store("items/{$item->id}", config('filesystems.cloud'));
        }

        $item->image = $target;
        return response()->json(collect($item->toArray())->only(['image', 'image_src'])->all());
    }

}
