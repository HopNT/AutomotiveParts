<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/5/2018
 * Time: 1:50 AM
 */

namespace App\Http\Common\Entities;


class Role extends BaseModel
{
    protected $table = 'tbl_role';

    protected $fillable = [
        'role_name',
        'description',
        'mn_selected_list'
    ];

    public $rules = [
        'role_name' => 'required|max:255|unique:tbl_role,',
        'description' =>"max:255",
        'mn_selected_list' => "required"
    ];

    public $rules_update = [
        'role_name' => 'required|max:255,',
        'description' =>"max:255",
        'mn_selected_list' => "required"
    ];

    public $messages = [
        'role_name.required' => 'Vui lòng nhập thông tin.',
        'role_name.max' => 'Vui lòng không nhập quá 255 kí tự.',
        'role_name.unique' => 'Tên đã tồn tại trong hệ thống, vui lòng chọn tên khác.',
        'description.max' => 'Vui lòng không nhập quá 255 kí tự.',
        'mn_selected_list.required' => 'Vui lòng chọn 1 trong các quyền bên dưới.',
    ];

    /**
     * The Menu that belong to the Role.
     */
    public function menus()
    {
        return $this->belongsToMany(Menu::class, 'tbl_menu_role', 'role_id', 'menu_id');
    }
}
