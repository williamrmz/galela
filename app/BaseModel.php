<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    public $timestamps = false;

    public $incrementing = false;
}
