<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 11/25/2018
 * Time: 17:54
 */

namespace App\Http\Common\Repository;

interface CarLinkRepository {

    function deleteAll($accessaryId);

    function findByIdValue($key, $value);
}
