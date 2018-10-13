<?php

namespace App\Http\Common\Entities;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Carbon;

class BaseModel extends Model
{
    protected $dateFormat = 'Y-m-d H:i:s';
    
    public static $duration = 31536000;

    public $timestamps = true;
}
