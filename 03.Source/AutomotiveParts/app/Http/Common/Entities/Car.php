<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:57
 */

namespace App\Http\Common\Entities;

class Car extends BaseModel {

    protected $table = 'tbl_car';

    protected $primaryKey = 'car_id';

    protected $fillable = [
//        'car_brand_id',
        'catalog_car_id',
        'car_manufacturer_id',
        'nation_id',
        'factory_id',
        'year_manufacture_id',
        'motion_system_id',
        'code',
        'name',
        'number_of_doors',
        'description',
        'status'
//        'parts[]'
    ];

    public $rules = [
//        'car_brand_id' => 'required|unique:tbl_car_brand',
        'catalog_car_id' => 'required',
        'name' => 'required|max:255',
        'code' => 'required|unique:tbl_car|max:255'
    ];

    public $attributes = [
//        'car_brand_id' => 'Hãng xe',
        'catalog_car_id' => 'Dòng xe',
        'name' => 'Tên xe',
        'code' => 'Mã xe'
    ];

    public function catalogCar() {
        return $this->belongsTo(CatalogCar::class, 'catalog_car_id');
    }

    public function carManufacturer() {
        return $this->belongsTo(CarManufacturer::class, 'car_manufacturer_id');
    }

    public function nation() {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function factory() {
        return $this->belongsTo(Factory::class, 'factory_id');
    }

    public function yearManufacture() {
        return $this->belongsTo(YearManufacture::class, 'year_manufacture_id');
    }

    public function motionSystem() {
        return $this->belongsTo(MotionSystem::class, 'motion_system_id');
    }

    public function catalogParts() {
        return $this->belongsToMany(Parts::class, 'tbl_car_catalog_parts', 'car_id', 'catalog_parts_id');
    }

}
