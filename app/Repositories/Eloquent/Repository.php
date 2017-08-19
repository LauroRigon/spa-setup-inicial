<?php

namespace App\Repositories\Eloquent;

use App\Repositories\Contracts\RepositoryInterface;

/**
 * Class Repository - Responsável por implementar RepositoryInterface
 * @package App\Repositories\Eloquent
 */
abstract class Repository implements RepositoryInterface
{
    /**
     * @var Classe model a qual será usada para criar o model
     */
    protected $modelClass;

    public $model;

    public function __construct()
    {
        $this->makeModel();
    }

    protected function makeModel()
    {
        $this->model = app()->make($this->modelClass)->newQuery();
    }

    /**
     * Trata os dados antes de usar create e update
     * @param array $data
     * @return array
     */
    protected function prepareData($data){
        return $data;
    }
    /**
     * @param array $columns - ['colum1', 'colum2']
     * @return Model
     */
    public function all($columns = ['*'])
    {
       return $this->model->get($columns);
    }

    /**
     * Retorna um paginator
     * @param int $perPage
     * @param array $columns - ['colum1', 'colum2']
     * @return Illuminate\Pagination\Paginator
     */
    public function paginate($perPage = 15, $columns = ['*'])
    {
        return $this->model->paginate($perPage, $columns);
    }

    /**
     * @param array $data - ['attName' => 'value', ...]
     * @return Model
     */
    public function create(array $data)
    {
        $data = $this->prepareData($data);

        return $this->model->create($data);
    }

    /**
     * @param array - $data ['attName' => 'value', ...]
     * @param $id
     * @param string $atribute
     * @return mixed
     */
    public function update(array $data, $id, $atribute = 'id')
    {
        $data = $this->prepareData($data);

        return $this->model->where($atribute, '=', $id)->update($data);
    }

    /**
     * @param $id
     * @return Bool
     */
    public function delete($id)
    {
        return $this->model->findOrFail($id)->delete();
    }

    /**
     * @param $id
     * @param array $columns
     * @return Model
     */
    public function find($id, $columns = ['*'])
    {
        return $this->model->find($id, $columns);
    }

    /**
     * @param $field
     * @param $value
     * @param array $columns
     * @return Model
     */
    public function findBy($field, $value, $columns = ['*'])
    {
        return $this->model->where($field, '=', $value)->first($columns);
    }
}