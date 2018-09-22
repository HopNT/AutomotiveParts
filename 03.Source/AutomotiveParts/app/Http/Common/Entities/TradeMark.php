<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:46
 */

namespace App\Http\Common\Entities;

class TradeMark extends BaseModel {

    protected $table = 'tbl_trademark';

    protected $primaryKey = 'trademark_id';

    protected $fillable = [
        'trademark_id',
        'code',
        'name',
        'description',
        'status'
    ];

    public $rules = [
        'code' => 'required|unique:tbl_nation|max:20'
    ];

    public $attributes = [
        'code' => 'Mã thương hiệu'
    ];

    public function accessarys() {
        return $this->hasMany(Accessary::class, 'trademark_id');
    }

}
