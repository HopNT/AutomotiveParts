<?php

namespace App\Http\Common\Entities;

use Illuminate\Database\Eloquent\Model;

class BaseModel extends Model
{
    protected $dateFormat = 'Y-m-d H:m:s';

    public $timestamps = true;
    
    public static $duration = 31536000;
}
