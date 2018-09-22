<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:54
 */

namespace App\Http\Common\Entities;

class CatalogCar extends BaseModel {

    protected $table = 'tbl_catalog_car';

    protected $primaryKey = 'catalog_car_id';

    protected $fillable = [
        'catalog_car_id',
        'car_brand_id',
        'name',
        'description',
        'status'
    ];

    public $rules = [
        'car_brand_id' => 'required',
        'name' => 'required|max:255'
    ];

    public $attributes = [
        'car_brand_id' => 'Hãng xe',
        'name' => 'Tên dòng xe'
    ];

    public function carBrand() {
        return $this->belongsTo(CarBrand::class, 'car_brand_id');
    }

    public function cars() {
        return $this->hasMany(Car::class, 'catalog_car_id');
    }
}
