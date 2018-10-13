<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/08/2018
 * Time: 15:21
 */
namespace App\Http\Common\Entities;

class AccessaryLink extends BaseModel {

    protected $table = 'tbl_accessary_link';

    protected $primaryKey = 'accessary_link_id';

    public $timestamps = false;

    protected $fillable = [
        'accessary_id',
        'accessary_value'
    ];

    public function accessary() {
        return $this->belongsTo(Accessary::class, 'accessary_id');
    }

}
