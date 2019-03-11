<?php

namespace Betta\LaravelIcal;

use Eluceo\iCal\Component\Alarm as BaseAlarm;
use Illuminate\Support\Arr;

class Alarm extends BaseAlarm
{
    /**
     * Resolvable arguments
     *
     * @var array
     */
    protected static $properties = [
        'action',
        'repeat',
        'duration',
        'attendee',
        'description',
    ];

    /**
     * Create new Alarm instance
     *
     * @return new static
     */
    public static function make($parameters = [])
    {
        # create new instance
        $alarm = new static;
        # if provided description
        foreach (static::$properties as $property) {
            # If we can get the value
            if ($value = Arr::get($parameters, $property)) {
                # call method
                $alarm->{'set'.$property}($value);
            }
        }
        # return
        return $alarm;
    }
}
