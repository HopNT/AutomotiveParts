<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/19/2018
 * Time: 09:09
 */
namespace App\Http\Common\Repository;

interface TradeMarkRepository
{
    function deleteMulti($ids);

    function findByCode($code);
}
