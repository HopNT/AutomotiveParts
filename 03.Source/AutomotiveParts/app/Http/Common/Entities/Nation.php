<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:39
 */

namespace App\Http\Common\Entities;
class Nation extends BaseModel {

    protected $table = 'tbl_nation';

    protected $primaryKey = 'nation_id';

    protected $fillable = [
        'code',
        'name_vi',
        'name_en',
        'description',
        'status'
    ];

    public $rules = [
        'code' => 'required|unique:tbl_nation|max:20'
    ];

    public $attributes = [
        'code' => 'Mã quốc gia'
    ];

    public function carBrands() {
        return $this->hasMany(CarBrand::class,'nation_id');
    }

    public function cars() {
        return $this->hasMany(Car::class, 'nation_id');
    }

    public function accessarys() {
        return $this->hasMany(Accessary::class, 'nation_id');
    }

}
