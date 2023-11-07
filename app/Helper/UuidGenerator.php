<?php

namespace App\Helper;

use Ramsey\Uuid\Uuid;

trait UuidGenerator
{
    protected static function generateUuid()
    {
        static::creating(function ($model) {
            $model->id=Uuid::uuid4()->toString();
        });
    }
}