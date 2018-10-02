<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 10:59
 */
namespace App\Http\Common\Entities;

class UserAccessary extends BaseModel
{
    protected $table = 'tbl_user_accessary';

    protected $primaryKey = 'user_accessary_id';

    protected $fillable = [
        'user_id',
        'accessary_id',
        'garage_price',
        'retail_price',
        'quantity',
        'status'
    ];

    public $rules = [
        'accessary_id' => 'required'
    ];

    public $attributes = [
        'accessary_id' => 'Phụ tùng'
    ];
}
