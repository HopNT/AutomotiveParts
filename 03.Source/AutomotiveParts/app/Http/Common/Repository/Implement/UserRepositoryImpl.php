<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 10/02/2018
 * Time: 01:23
 */
namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Entities\UserDb;
use App\Http\Common\Repository\UserRepository;

class UserRepositoryImpl extends GenericRepositoryImpl implements UserRepository
{
    /**
     * @return mixed
     */
    public function getModel()
    {
        return UserDb::class;
    }
}
