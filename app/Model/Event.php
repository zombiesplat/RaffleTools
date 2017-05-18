<?php

namespace App\Model;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Event extends Model
{
    use SoftDeletes;

    /**
     * slugs and descriptions of raffle event types
     */
    const TYPES = [ // these are actually prize types...
        'auction' => 'Auction',
        'meat_markeet' => 'Bachelor / Bachelorette Auction',
        'gala' => 'Gala Ball',
        'dinner' => 'Networking Dinner',
        'prom' => 'Prom',
        'poker' => 'Poker Tournament',
        'casino' => 'Casino Night',
        'online' => 'Online',
        'walk_run' => '5K Walk/Run',
        'obstacle_course' => 'Obstacle Course',
        'calendar' => 'Awareness Week', // A calendar raffle offers money or prizes and is intended to be an event that runs over the course of a week or month, giving away a prize a day for the specified time period. Calendar raffle tickets are usually sold in advance, as the tickets should not be sold during the period in which the raffle takes place. An organization that is able to obtain a large number of rather inexpensive prizes -- such as gift certificates or free restaurant meals or services -- might consider a calendar give-away. For this raffle, the inexpensive prizes are given away each day of a designated month.
        'golf' => 'Golf Tournament',

        'trivia' => 'Trivia Tournament',
        'yard_sale' => 'Yard Sale',
        'bake_sale' => 'Bake Sale',
        'talent_show' => 'Talent Show',

        'happy_hour' => 'Alumni Happy Hour',
        'jail_bail' => 'Jail and Bail', //Detainees must raise money to be let out of jail
        'scavenger_hunt' => 'Scavenger Hunt',
        'biggest_loser' => 'Weight Loss-a-Thon',
        'sports_clinic' => 'Sports Clinic',

        'hoops' => 'Hoops for Hope',
        'talent' => 'Battle of the Bands',
        'bingo' => 'Bingo Night',
        'caroling' => 'Caroling for a Cause', //door to door in a neighborhood, maybe the app could help collect donations?
        'bake_off' => 'Bake Off',
        'game_night' => 'Game Night',
        'wacky_wager' => 'Wacky Wager', // if we get to X goal, you will see me doing something wacky.. kind of thing

    ];

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
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'type_name'
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
     * override the default setter for open date time
     * @param string $value
     * @return string
     */
    public function setOpenDateTimeAttribute($value)
    {
        $this->attributes['open_date_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
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

    /**
     * override the default setter for drawing date time
     * @param string $value
     * @return string
     */
    public function setDrawingDateTimeAttribute($value)
    {
        $this->attributes['drawing_date_time'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }
}
