<?php
/**
 * Created by PhpStorm.
 * User: Windows
 * Date: 9/12/2018
 * Time: 1:43 AM
 */

namespace App\Http\Common\Entities;


class Menu extends BaseModel
{
    protected $table = 'tbl_menu';

    public $timestamps = false;

    protected $fillable = [
        'parent_id',
        'menu_name',
        'display_order',
        'meta_title',
        'function_name',
        'description',
        'menu_url',
        'is_deleted',
        'is_menu',
        'route_name',
        'event_id'
    ];

    protected $guarded = [];

    public function pages()
    {
        return $this->hasMany(Menu::class, 'parent_id', 'id' );
    }
    public function allChildren()
    {
        return $this->pages()->with('allChildren')->orderBy('display_order', "asc");
    }

    public function getLstChildId($childs){
        if(count($childs) == 0){
            return '';
        }
        $val = [];
        foreach ($childs as $chld){
            $val[] = $chld->id;
        }
        $val = implode(",", $val);
        return $val;
    }
}
