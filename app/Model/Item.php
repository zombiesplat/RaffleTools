<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use SoftDeletes;

    /**
     * slugs and descriptions of raffle event types
     */
    const TYPES = [ // these are actually prize types...
        'single' => 'Single-Prize',
        'basket' => 'Multiple-Prize Items in a Basket',
        'split_pot' => 'Split Pot', // The prize money offered can be a pre-determined amount or a percentage of the total money raised through the ticket sales.
        'cash' => 'Cash Prize', //set amount not determined by entries
        'travel' => 'Travel Package',
        'door' => 'Door Prize',

    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'type_name'
    ];

    /**
     * Attributes that should be mutated to dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    /**
     * getter for the appended attribute type_name
     * @return string
     */
    public function getTypeNameAttribute()
    {
        if (isset(self::TYPES[$this->attributes['type']])) {
            return self::TYPES[$this->attributes['type']];
        }
        return '';
    }
}
