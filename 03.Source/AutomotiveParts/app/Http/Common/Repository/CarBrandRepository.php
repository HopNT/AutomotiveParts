<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 16:09
 */
namespace App\Http\Common\Repository;

interface CarBrandRepository
{
    /**
     * @param $status
     * @return mixed
     */
    function getAllWitActive($status);

    /**
     * @param $ids
     * @return mixed
     */
    function deleteMulti($ids);


    /**
     * @param $nationId
     * @return mixed
     */
    function updateNation($nationId);
}
