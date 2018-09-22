<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 10:36
 */
namespace App\Http\Common\Repository;

interface PartsRepository
{
    function getAllByActive($status);
}
