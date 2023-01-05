<?php

namespace Betta\LaravelIcal\Contracts;

use Eluceo\iCal\Component\Calendar;

interface Event
{
    public const METHOD_PUBLISH = Calendar::METHOD_PUBLISH;
    public const METHOD_REQUEST = Calendar::METHOD_REQUEST;
    public const METHOD_REPLY = Calendar::METHOD_REPLY;
    public const METHOD_ADD = Calendar::METHOD_ADD;
    public const METHOD_CANCEL = Calendar::METHOD_CANCEL;
    public const METHOD_REFRESH = Calendar::METHOD_REFRESH;
    public const METHOD_COUNTER = Calendar::METHOD_COUNTER;
    public const METHOD_DECLINECOUNTER = Calendar::METHOD_DECLINECOUNTER;
}
