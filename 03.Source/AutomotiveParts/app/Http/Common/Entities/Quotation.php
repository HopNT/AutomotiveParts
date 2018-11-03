<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 10/29/2018
 * Time: 22:20
 */
namespace App\Http\Common\Entities;

class Quotation extends BaseModel {

    protected $table = 'tbl_quotation';

    protected $primaryKey = 'quotation_id';

    protected $fillable = [
//        'quotation_id',
        'user_id',
        'code'
    ];

    public function user() {
        return $this->belongsTo(UserDb::class, 'user_id');
    }

    public function tempPrices() {
        return $this->hasMany(TempPrice::class, 'quotation_id');
    }
}
