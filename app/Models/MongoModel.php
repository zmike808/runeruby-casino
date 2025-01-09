<?php

namespace App\Models;

use MongoDB\Laravel\Eloquent\Model;
use MongoDB\BSON\UTCDateTime;
use DateTimeInterface;

abstract class MongoModel extends Model
{
    public function freshTimestamp(): UTCDateTime
    {
        return new UTCDateTime(round(microtime(true) * 1000));
    }

    protected function serializeDate(DateTimeInterface $date): UTCDateTime
    {
        return new UTCDateTime($date);
    }

    protected function asDateTime($value): \DateTime
    {
        if ($value instanceof UTCDateTime) {
            return $value->toDateTime();
        }

        return parent::asDateTime($value);
    }
}
