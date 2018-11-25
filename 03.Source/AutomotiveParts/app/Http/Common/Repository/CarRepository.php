<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/07/2018
 * Time: 08:56
 */
namespace App\Http\Common\Repository;

interface CarRepository
{
    /**
     * @param $status
     * @return mixed
     */
    function getAllWithActive($status);

    /**
     * @param $ids
     * @return mixed
     */
    function deleteMulti($ids);

    /**
     * @param $code
     * @return mixed
     */
    function getByAccessary($code);

    /**
     * @param $accessaryId
     * @return mixed
     */
    function getByAccessaryId($accessaryId);

    /**
     * @param $catalogCarId
     * @return mixed
     */
    function getByCatalog($catalogCarId);

    /**
     * @param $text
     * @return mixed
     */
    function searchByText($text);
}
