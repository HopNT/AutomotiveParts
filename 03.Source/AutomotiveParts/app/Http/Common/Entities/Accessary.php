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

    protected $fillable = [];

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
}
