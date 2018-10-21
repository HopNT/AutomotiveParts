<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 19:02
 */

namespace App\Http\Common\Entities;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class UserDb extends Authenticatable {

    use Notifiable;

    protected $table = 'tbl_user';

    protected $primaryKey = 'user_id';

    protected $fillable = [
        'name',
        'birth_day',
        'gender',
        'identify_card',
        'driving_license',
        'address',
        'phone_number',
        'fax',
        'email',
        'username',
        'password',
        'user_type',
        'status',
        'created_at',
        'updated_at',
        'remember_token',
        'role_id'
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function accessarys() {
        return $this->belongsToMany(Accessary::class, 'tbl_user_accessary', 'user_id', 'accessary_id');
    }

    public function roles(){
        return $this->hasOne(Role::class,'id', 'role_id');
    }

    public $rules = [
        'name'=>'required',
        'birth_day' => 'required',
        'gender' =>"required",
        'email' =>"required|email",
        'phone_number' =>"required|max:13",
        'role_id' =>"required",
        'user_type' => "required"
    ];

    public $rule_update_profile = [
        'name'=>'required',
        'birth_day' => 'required',
        'gender' =>"required",
        'email' =>"required|email",
        'phone_number' =>"required|max:13",
    ];

    public $rule_update_password = [
        'password' => array(
            'required',
            'min:4',
            'max:20',
            'confirmed',
            'regex:/^[a-zA-Z0-9!$#%]{4,20}/'
        ),
        'password_confirmation' => array(
            'required',
            'same:password'
        )
    ];

    public $messages = [
        'name.required'=>'Vui lòng nhập thông tin.',
        'birth_day.required'=>'Vui lòng nhập thông tin.',
        'gender.required'=>'Vui lòng nhập thông tin.',
        'email.required'=>'Vui lòng nhập thông tin.',
        'email.email'=>'Địa chỉ email không hợp lệ.',
        'phone_number.required'=>'Vui lòng nhập thông tin.',
        'phone_number.max'=>'SĐT không vượt quá 13 kí tự',
        'role_id.required'=>'Vui lòng nhập thông tin.',
        'user_type.required'=>'Vui lòng nhập thông tin.',
    ];
    /**
     * check permission
     * @param string $route_name
     * @param type $event_id
     * @return boolean
     */
    public function can_view($route_name, $event_id = '') {
        if ($route_name == 'admin_home') {
            $route_name = 'account-management';
        }

        if (empty($this->permistions) || empty($route_name)) {
            return false;
        }
        //permistions [["mn.id","mn.menu_name", "mn.action","mn.event_id","mn.menu_url","mn.route_name"]]
        $arr_route_name = [];
        if (!empty($event_id)) {
            foreach ($this->permistions as $v) {
                if(!$v->route_name){
                    continue;
                }
                $arr_route_name = explode( "|", $v->route_name);
                if (in_array($route_name, $arr_route_name) && $v->event_id == $event_id) {
                    return true;
                }
            }
            return false;
        }
        foreach ($this->permistions as $v) {
            if(!$v->route_name){
                continue;
            }

            $arr_route_name = explode("|", $v->route_name);
            if (in_array($route_name, $arr_route_name)) {
                return true;
            }
        }
        return false;
    }

}
