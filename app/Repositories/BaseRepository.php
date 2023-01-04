<?php

namespace App\Repositories;

use App\Interfaces\EloquentRepositoryInterface;
use App\Models\Model;

class BaseRepository implements EloquentRepositoryInterface
{
    /**
     * @var Model
     */
    protected $model;

    /**
     * BaseRepository constructor.
     *
     * @param Model|Authenticatable $model
     */
    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return Model
     */
    public function create(array $attributes): Model
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @return Model
     */
    public function find($id): ?Model
    {
        return $this->model->find($id);
    }

    /**
     * @param string $attribute
     * @return Model
     */
    public function findBy($attribute, $value): ?Model
    {
        return $this->model->where($attribute, $value)->first();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return Model
     */
    public function update($attributes, $id): ?Model
    {
        $model = $this->find($id);
        $model->update($attributes);

        return $model;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return Model
     */
    public function updateOrCreate($attributes, $values): ?Model
    {
        return $this->model->updateOrCreate($attributes, $values);
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id): ?bool
    {
        return $this->find($id)->delete();
    }

    /**
     * @param $condition
     * @return bool
     */
    public function deleteWhere($attribute, $value): ?bool
    {
        return $this->model->where($attribute, $value)->delete();
    }
}
