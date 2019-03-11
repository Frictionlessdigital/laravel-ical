<?php

namespace Betta\LaravelIcal;

use Eluceo\iCal\Component;
use Eluceo\iCal\Component\Calendar as BaseCalendar;
use Eluceo\iCal\Component\Event;

class Calendar extends BaseCalendar
{
    /**
     * Create new instance of Calendar
     *
     * @param string $prodId
     */
    public function __construct($prodId)
    {
        # If not provided, assume application name
        $prodId = $prodId ?: config('app.name');
        # Defer to parent
        parent::__construct($prodId);
    }

    /**
     * Adds a Component.
     *
     * If $key is given, the component at $key will be replaced else the component will be append.
     *
     * @param Component $component The Component that will be added
     * @param null      $key       The key of the Component
     */
    public function addComponent(Component $component, $key = null)
    {
        parent::addComponent($component, $key);

        return $this;
    }
}
