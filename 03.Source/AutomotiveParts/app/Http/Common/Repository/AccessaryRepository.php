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

    function findByCode($code);

    function deleteMulti($ids);

    function searchByCode($query);

    function searchById($accessaryId);

    function loadByPartsId($arrayPartsId);

    function findCarUsed($accessaryId);
}
