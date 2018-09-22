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

    protected $fillable = [];

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

    public function parts() {
        return $this->belongsToMany(Parts::class, 'tbl_car_parts', 'car_id', 'parts_id');
    }

}
