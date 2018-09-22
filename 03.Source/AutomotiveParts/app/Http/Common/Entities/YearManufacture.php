<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:47
 */

namespace App\Http\Common\Entities;

class YearManufacture extends BaseModel {

    protected $table = 'tbl_year_manufacture';

    protected $primaryKey = 'year_manufacture_id';

    protected $fillable = [];

    public function cars() {
        return $this->hasMany(Car::class, 'year_manufacture_id');
    }

}
