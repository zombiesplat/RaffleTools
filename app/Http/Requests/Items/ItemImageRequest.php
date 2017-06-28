<?php
namespace App\Http\Requests\Items;

use App\Model\Item;
use Illuminate\Foundation\Http\FormRequest;

class ItemImageRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        $item = $this->route('item');
        return \Auth::user()->can('update', $item);
    }

    /**
     * Get the validation rules for the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'file' => 'required|max:10000|mimes:jpg,jpeg,png,tif,tiff,bmp,gif'
        ];
    }
}
