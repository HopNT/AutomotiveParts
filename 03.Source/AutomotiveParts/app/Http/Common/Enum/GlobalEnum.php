<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:32 AM
 */

namespace App\Http\Common\Enum;


class GlobalEnum
{
    const STATUS_ACTIVE = 1;
    const STATUS_INACTIVE = 0;
    const STATUS_APPROVE = 2;
    const STATUS_REJECT = 3;
    const STATUS_PENDING = 4;

    const ADMIN = 0;
    const PROVIDER = 1;
    const CLIENT = 2;

    const MALE = 1;
    const FEMALE = 0;

    const IMAGE = 'images';
    const ICON = 'icon';
    const DOC = 'documentations';

	public static function getAllUserType(){
        return [
            ''=>'--- Mời chọn ---',
            self::ADMIN => 'Quản trị viên',
            self::PROVIDER => 'Nhà cung cấp',
            self::CLIENT => 'Khách hàng'
        ];
    }	
}
