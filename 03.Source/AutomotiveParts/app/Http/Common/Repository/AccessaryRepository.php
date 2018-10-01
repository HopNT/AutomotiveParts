<?php
/**
 * Created by PhpStorm.
 * User: vanma
 * Date: 09/23/2018
 * Time: 17:47
 */
namespace App\Http\Common\Repository;

interface AccessaryRepository
{
    function searchByText($text);
}
