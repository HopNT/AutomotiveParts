<?php
/**
 * Created by PhpStorm.
 * User: ManhNV
 * Date: 09/06/2018
 * Time: 16:01
 */

namespace App\Http\Common\Repository\Implement;

use App\Http\Common\Repository\GenericRepository;

abstract class GenericRepositoryImpl implements GenericRepository
{
    protected $_model;

    /**
     * GenericRepositoryImpl constructor.
     */
    public function __construct()
    {
        $this->setModel();
    }

    /**
     * @return mixed
     */
    abstract public function getModel();

    public function setModel()
    {
        $this->_model = app()->make($this->getModel());
    }

    /**
     * @return mixed
     */
    function getAll()
    {
        return $this->_model->all();
    }

    /**
     * @param $id
     * @return mixed
     */
    function find($id)
    {
        return $this->_model->find($id);
    }

    /**
     * @param $attributes
     * @return mixed
     */
    function persist($attributes)
    {
        return $this->_model->create($attributes);
    }

    /**
     * @param $id
     * @param $attributes
     * @return bool|mixed
     */
    function merge($id, $attributes)
    {
        $result = $this->find($id);
        if ($result)
        {
            $result->update($attributes);
            return $result;
        }
        return false;
    }

    /**
     * @param $id
     * @return bool|mixed
     */
    function delete($id)
    {
        $result = $this->find($id);
        if ($result)
        {
            $result->delete();
            return true;
        }
        return false;
    }

}
