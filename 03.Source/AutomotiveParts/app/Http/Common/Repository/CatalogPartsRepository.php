<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/14/2018
 * Time: 10:33
 */

namespace App\Http\Common\Repository;

interface CatalogPartsRepository
{
    function deleteMulti($ids);

    function searchByText($text);

    function searchByTextParent($text);

    function getCatalogPartsIdByCode($code);

    function deleteCarCatalogParts($catalogPartsId);

    function deleteCatalogPartsAccessary($catalogPartsId);
}
