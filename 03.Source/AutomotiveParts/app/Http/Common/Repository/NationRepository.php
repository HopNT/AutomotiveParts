<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 16:15
 */
namespace App\Http\Common\Repository;

interface NationRepository extends GenericRepository
{
    /**
     * @param $ids
     * @return mixed
     */
    function deleteMulti($ids);

    /**
     * @param $code
     * @return mixed
     */
    function findByCode($code);
}
