<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 09:23
 */

namespace App\Http\Common\Entities;

class CatalogAccessary extends BaseModel {

    protected $table = 'tbl_catalog_accessary';

    protected $primaryKey = 'catalog_accessary_id';

    protected $fillable = [];

    public function children() {
        return $this->hasMany(CatalogAccessary::class, 'parent_id', 'catalog_accessary_id');
    }

    public function parent() {
        return $this->hasOne(CatalogAccessary::class, 'catalog_accessary_id', 'parent_id');
    }

    public function accessarys() {
        return $this->hasMany(Accessary::class, 'catalog_accessary_id');
    }

}
