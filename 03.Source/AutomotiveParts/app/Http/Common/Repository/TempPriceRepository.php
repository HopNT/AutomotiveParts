<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/03/2018
 * Time: 10:03
 */
namespace App\Http\Common\Repository;

interface TempPriceRepository
{
    function getAllByAdmin();

    function getAllByProductProvider($userId);

    function deleteMulti($ids);

    function approve($ids);

    function reject($ids);

    function findByCodeAndUserId($code, $userId);
}
