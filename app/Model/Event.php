<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    /**
     * Attributes that should be mutated to dates
     * @var array
     */
    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
        'open_date_time',
        'drawing_date_time',
    ];

    /**
     * override the default getter for open date time
     * @param string $value
     * @return string
     */
    public function getOpenDateTimeAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y g:i A');
    }

    /**
     * override the default getter for drawing date time
     * @param string $value
     * @return string
     */
    public function getDrawingDateTimeAttribute($value)
    {
        return Carbon::parse($value)->format('m/d/Y g:i A');
    }
}
