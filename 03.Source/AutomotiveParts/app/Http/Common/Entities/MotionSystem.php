<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/05/2018
 * Time: 16:45
 */

namespace App\Http\Common\Entities;

class MotionSystem extends BaseModel {

    protected $table = 'tbl_motion_system';

    protected $primaryKey = 'motion_system_id';

    protected $fillable = [];

    public function cars() {
        return $this->hasMany(Car::class, 'motion_system_id');
    }

}
