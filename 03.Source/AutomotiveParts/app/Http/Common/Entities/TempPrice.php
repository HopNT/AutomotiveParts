<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/03/2018
 * Time: 10:01
 */
namespace App\Http\Common\Entities;

class TempPrice extends BaseModel
{
    protected $table = 'tbl_temp_price';

    protected $fillable = [
        'trademark_id',
        'nation_id',
        'user_id',
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
        'garage_price',
        'retail_price',
        'quantity',
        'status',
        'photo_top_image'
    ];

    public $rules = [
        'code' => 'required',
        'name_vi' => 'required|max:100'
    ];

    public $attributes = [
        'code' => 'Mã phụ tùng',
        'name_vi' => 'Tên tiếng Việt'
    ];

    protected $primaryKey = 'temp_price_id';
}
