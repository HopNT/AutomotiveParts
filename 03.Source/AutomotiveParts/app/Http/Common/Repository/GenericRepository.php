<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 15:59
 */

namespace App\Http\Common\Repository;

interface GenericRepository
{
    /**
     * @return mixed
     */
    function getAll();

    /**
     * @param $id
     * @return mixed
     */
    function find($id);

    /**
     * @param $attributes
     * @return mixed
     */
    function persist($attributes);

    /**
     * @param $id
     * @param $attributes
     * @return mixed
     */
    function merge($id, $attributes);

    /**
     * @param $id
     * @return mixed
     */
    function delete($id);
}
