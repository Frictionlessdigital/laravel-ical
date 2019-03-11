<?php

namespace Betta\LaravelIcal;

use Betta\LaravelIcal\Contracts\Event as EventContract;
use Eluceo\iCal\Component\Event as BaseEvent;
use Illuminate\Contracts\Support\Renderable;

class Event extends BaseEvent implements EventContract, Renderable
{
    /**
     * Build the Calendar
     *
     * @var Betta\LaravelIcal\Calendar
     */
    private $calendar;

    /**
     * Set the product_id.
     *
     * @param string|null $product_id
     * @param string|null $unique_id
     *
     * @return $this
     */
    public function __construct(string $product_id = null, string $unique_id = null)
    {
        # Create parent event
        parent::__construct($unique_id);
        # Set the calendar
        $this->calendar = new Calendar($product_id);
        $this->calendar->setCalendarScale(Calendar::CALSCALE_GREGORIAN);
        $this->setPublishMethod();
    }

    /**
     * Render event.
     *
     * @return string
     */
    public function __toString()
    {
        $this->calendar->addComponent($this);

        return $this->calendar->render();
    }

    /**
     * Get the evaluated contents of the object.
     *
     * @return string
     */
    public function render()
    {
        return $this->__toString();
    }

    /**
     * Static method to create new instance
     *
     * @param  string|null $product_id
     * @param  string|null $unique_id
     *
     * @return new static
     */
    public static function make(string $product_id = null, string $unique_id = null)
    {
        return new static($product_id, $unique_id);
    }

    /**
     * Add attendee.
     *
     * @param string $email_address
     * @param string $name
     * @param array  $paramaters
     *
     * @return Event
     */
    public function addAttendee($email_address, $name = '', $paramaters = [])
    {
        $paramaters['mailto'] = $email_address;

        if (!array_has($paramaters, 'CUTYPE')) {
            $paramaters['CUTYPE'] = 'INDIVIDUAL';
        }

        if (!array_has($paramaters, 'ROLE')) {
            $paramaters['ROLE'] = 'REQ-PARTICIPANT';
        }

        if (!array_has($paramaters, 'PARTSTAT')) {
            $paramaters['PARTSTAT'] = 'NEEDS-ACTION';
        }

        if (!array_has($paramaters, 'RSVP')) {
            $paramaters['RSVP'] = 'TRUE';
        }

        if (empty($name)) {
            $name = $email_address;
        }

        parent::addAttendee('CN='.$name, $paramaters);

        return $this;
    }

    /**
     * Set organizer.
     *
     * @param string $email_address
     * @param string $name
     * @param array  $paramaters
     *
     * @return Event
     */
    public function addOrganizer($email_address, $name = '', $paramaters = [])
    {
        $paramaters['mailto'] = $email_address;

        if (empty($name)) {
            $name = $email_address;
        }

        parent::setOrganizer(new Organizer('CN='.$name, $paramaters));

        return $this;
    }

    /**
     * Set organizer.
     *
     * @param int $time
     * @param array  $paramaters
     *
     * @return Event
     */
    public function addAlarm($time = 0, $parameters = [])
    {
        $alarm = Alarm::make($parameters)->setTrigger('-PT'.$time.'M');

        $this->addComponent($alarm);

        return $this;
    }

    /**
     * Set a calendar property.
     *
     * @return Event
     */
    public function setCalendar($method, $value)
    {
        $this->calendar->{'set'.$method}($value);

        return $this;
    }

    /**
     * Set the method to publish.
     *
     * @return Event
     */
    public function setPublishMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_PUBLISH);
    }

    /**
     * Set the method to request.
     *
     * @return Event
     */
    public function setRequestMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_REQUEST);
    }

    /**
     * Set the method to reply.
     *
     * @return Event
     */
    public function setReplyMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_REPLY);
    }

    /**
     * Set the method to add.
     *
     * @return Event
     */
    public function setAddMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_ADD);
    }

    /**
     * Set the method to cancel.
     *
     * @return Event
     */
    public function setCancelMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_CANCEL);
    }

    /**
     * Set the method to refresh.
     *
     * @return Event
     */
    public function setRefreshMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_REFRESH);
    }

    /**
     * Set the method to counter.
     *
     * @return Event
     */
    public function setCounterMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_COUNTER);
    }

    /**
     * Set the method to counter.
     *
     * @return Event
     */
    public function setDeclineCounterMethod()
    {
        return $this->setCalendar('method', Calendar::METHOD_DECLINECOUNTER);
    }

    /**
     * Download the event ics.
     *
     * @param string $product_id
     * @param string $filename
     *
     * @return string
     */
    public function download($filename = 'ical')
    {
        $contents = $this->render();

        return response($contents)->withHeaders([
            'Content-Type' => 'text/calendar; charset=utf-8',
            'Content-Disposition' => 'attachment; filename="'.$filename.'.ics"',
        ]);
    }
}
