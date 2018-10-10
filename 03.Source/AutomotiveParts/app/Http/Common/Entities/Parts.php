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

    protected $fillable = [
        'catalog_parts_id',
        'code',
        'name',
        'width',
        'height',
        'number_of_tooth',
        'inner_diameter',
        'outer_diameter',
        'photo',
        'photo_name',
        'torque',
        'life_cycle',
        'weight',
        'liquor',
        'description',
        'status',
        'accessary[]',
        'image_file'
    ];

    public $rules = [
        'catalog_parts_id' => 'required',
        'code' => 'required|unique:tbl_parts|max:20'
    ];

    public $rules_update = [
        'catalog_parts_id' => 'required',
//        'code' => 'required|unique:tbl_parts|max:20'
    ];

    public $attributes = [
        'catalog_parts_id' => 'Nhóm bộ phận xe',
        'code' => 'Mã bộ phận xe'
    ];

    public function catalogParts() {
        return $this->belongsTo(CatalogParts::class, 'catalog_parts_id');
    }

    public function accessarys() {
        return $this->belongsToMany(Accessary::class, 'tbl_parts_accessary', 'parts_id', 'accessary_id');
    }

    public function cars() {
        return $this->belongsToMany(Car::class, 'tbl_car_parts', 'parts_id', 'car_id');
    }

}
