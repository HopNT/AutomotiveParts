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
        'catalog_parts_id',
        'icon',
        'icon_name',
        'parent_id',
        'name',
        'description',
        'status'
    ];

    public $rules = [
        'name' => 'required|max:255'
    ];

    public $attributes = [
        'name' => 'Tên nhóm bộ phận xe'
    ];

    public function parent() {
        return $this->belongsTo('tbl_catalog_parts', 'parent_id');
    }

    public function child() {
        return $this->hasMany('tbl_catalog_parts', 'parent_id');
    }

    public function parts() {
        return $this->hasMany(Parts::class, 'catalog_parts_id');
    }

}
