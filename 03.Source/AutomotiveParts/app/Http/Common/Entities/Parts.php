<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 09:33
 */

namespace App\Http\Common\Entities;

class Parts extends BaseModel {

    protected $table = 'tbl_parts';

    protected $primaryKey = 'parts_id';

    protected $fillable = [];

    public function catalogParts() {
        return $this->belongsTo(CatalogParts::class, 'catalog_parts_id');
    }

    public function accessarys() {
//        return $this->hasMany(Accessary::class, 'parts_id');
        return $this->belongsToMany(Accessary::class, 'tbl_parts_accessary', 'parts_id', 'accessary_id');
    }

    public function cars() {
        return $this->belongsToMany(Car::class, 'tbl_car_parts', 'parts_id', 'car_id');
    }

}
