<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:55
 */
namespace App\Http\Common\Repository;

interface CatalogCarRepository
{
    /**
     * @param $status
     * @return mixed
     */
    function getAllWithActive($status);

    /**
     * @param $ids
     * @return mixed
     */
    function deleteMulti($ids);

    /**
     * @param $carBrandId
     * @return mixed
     */
    function getByCarBrand($carBrandId);
}
