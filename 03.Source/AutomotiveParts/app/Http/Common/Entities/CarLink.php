<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/25/2018
 * Time: 17:41
 */

namespace App\Http\Common\Entities;

class CarLink extends BaseModel {

    protected $table = 'tbl_car_link';

    protected $primaryKey = 'car_link_id';

    public $timestamps = false;

    protected $fillable = [
        'accessary_id',
        'car_id'
    ];

    public function accessary() {
        return $this->belongsTo(Accessary::class, 'accessary_id');
    }

}
