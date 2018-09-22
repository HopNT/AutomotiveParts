<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:43
 */

namespace App\Http\Common\Entities;

class Factory extends BaseModel {

    protected $table = 'tbl_factory';

    protected $primaryKey = 'factory_id';

    protected $fillable = [];

    public function cars() {
        return $this->hasMany(Car::class, 'factory_id');
    }

}
