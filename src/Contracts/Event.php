<?php

namespace Betta\LaravelIcal\Contracts;

use Eluceo\iCal\Component\Calendar;

interface Event
{
    const METHOD_PUBLISH = Calendar::METHOD_PUBLISH;
    const METHOD_REQUEST = Calendar::METHOD_REQUEST;
    const METHOD_REPLY = Calendar::METHOD_REPLY;
    const METHOD_ADD = Calendar::METHOD_ADD;
    const METHOD_CANCEL = Calendar::METHOD_CANCEL;
    const METHOD_REFRESH = Calendar::METHOD_REFRESH;
    const METHOD_COUNTER = Calendar::METHOD_COUNTER;
    const METHOD_DECLINECOUNTER = Calendar::METHOD_DECLINECOUNTER;
}
