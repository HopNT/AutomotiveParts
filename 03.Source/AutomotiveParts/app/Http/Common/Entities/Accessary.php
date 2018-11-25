<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 09:27
 */

namespace App\Http\Common\Entities;

class Accessary extends BaseModel {

    protected $table = 'tbl_accessary';

    protected $primaryKey = 'accessary_id';

    protected $fillable = [
        'car_id',
//        'car_used',
        'trademark_id',
        'nation_id',
        'type',
        'code',
        'name_en',
        'name_vi',
        'acronym_name',
        'unsigned_name',
        'photo_top',
        'photo_top_name',
        'photo_bottom',
        'photo_bottom_name',
        'photo_left',
        'photo_left_name',
        'photo_right',
        'photo_right_name',
        'photo_inner',
        'photo_inner_name',
        'photo_outer',
        'photo_outer_name',
        'description',
        'prioritize',
        'price',
        'status'
    ];

    public $rules = [
        'code' => 'required|unique:tbl_accessary',
        'name_vi' => 'required|max:100'
    ];

    public $attributes = [
        'code' => 'Mã phụ tùng',
        'name_vi' => 'Tên tiếng Việt'
    ];

    public function catalogAccessary() {
        return $this->belongsTo(CatalogAccessary::class, 'catalog_accessary_id');
    }

    public function parts() {
        return $this->belongsToMany(Parts::class, 'tbl_parts_accessary', 'accessary_id', 'parts_id');
    }

    public function tradeMark() {
        return $this->belongsTo(TradeMark::class, 'trade_mark_id');
    }

    public function nation() {
        return $this->belongsTo(Nation::class, 'nation_id');
    }

    public function userDbs() {
        return $this->belongsToMany(UserDb::class, 'tbl_user_accessary', 'accessary_id', 'user_id');
    }

    public function accessaryLinks() {
        return $this->hasMany(AccessaryLink::class, 'accessary_id');
    }

    public function carLinks() {
        return $this->hasMany(CarLink::class, 'accessary_id');
    }

}
