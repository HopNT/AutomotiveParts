<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:48
 */

namespace App\Http\Common\Entities;

class CarBrand extends BaseModel {

    protected $table = 'tbl_car_brand';

    protected $primaryKey = 'car_brand_id';

    protected $fillable = [
        'code_brand',
        'name',
        'nation_id',
        'description',
        'status'
    ];

    public $rules = [
        'code_brand' => 'required|unique:tbl_car_brand|max:255',
        'name' => 'required|max:255'
    ];

    public $rules_update = [
        'name' => 'required|max:255'
    ];

    public $attributes = [
        'code_brand' => 'Mã hãng xe',
        'name' => 'Tên hãng xe'
    ];

    public function nation() {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function catalogCars() {
        return $this->hasMany(CatalogCar::class, 'car_brand_id');
    }
}
