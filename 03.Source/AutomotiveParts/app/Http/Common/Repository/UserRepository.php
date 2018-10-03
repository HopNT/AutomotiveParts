<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:23
 */
namespace App\Http\Common\Repository;

interface UserRepository
{
    function getAllJoinDataWithProductProvider($userId);

    function getAllJoinDataWithAdmin();

    function getPrice($userAccessaryId);

    function deleteMulti($ids);
}
