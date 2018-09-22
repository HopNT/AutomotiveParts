<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:42
 */

namespace App\Http\Common\Entities;

class  CarManufacturer extends BaseModel {

    protected $table = 'tbl_car_manufacturer';

    protected $primaryKey = 'car_manufacturer_id';

    protected $fillable = [];

    public function cars() {
        return $this->hasMany(Car::class, 'car_manufacturer_id');
    }

}
