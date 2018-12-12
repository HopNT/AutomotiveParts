<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/11/2018
 * Time: 10:22
 */
namespace App\Http\Common\Repository;

interface AccessaryLinkRepository {

    function deleteAll($accessaryId);

    function getAccessaryLinks($accessaryId);

    function findByIdValue($key, $value);

    function deleteByAccessaryId($accessaryId);
}
