<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 09:32
 */
namespace App\Http\Common\Entities;

class CatalogParts extends BaseModel {

    protected $table = 'tbl_catalog_parts';

    protected $primaryKey = 'catalog_parts_id';

    protected $fillable = [
        'icon',
        'icon_name',
        'parent_id',
        'code',
        'name',
        'description',
        'status'
    ];

    public $rules = [
        'code' => 'required|max:255',
        'name' => 'required|max:255'
    ];

    public $attributes = [
        'code' => 'Mã nhóm bộ phận xe',
        'name' => 'Tên nhóm bộ phận xe'
    ];

    public function parent() {
        return $this->belongsTo(CatalogParts::class, 'parent_id');
    }

    public function child() {
        return $this->hasMany(CatalogParts::class, 'parent_id');
    }

    public function parts() {
        return $this->hasMany(Parts::class, 'catalog_parts_id');
    }

    public function accessarys() {
        return $this->belongsToMany(Accessary::class, 'tbl_catalog_parts_accessary', 'catalog_parts_id', 'accessary_id');
    }

    public function cars() {
        return $this->belongsToMany(Car::class, 'tbl_car_catalog_parts', 'catalog_parts_id', 'car_id');
    }

}
