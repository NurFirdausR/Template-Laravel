<?php

namespace App\Interfaces;

use App\Models\Model;

interface EloquentRepositoryInterface
{
    /**
     * @param array $attributes
     * @return Model
    */
    public function create(array $attributes): Model;

    /**
     * @param int $id
     * @return Model
    */
    public function find($id): ?Model;

    /**
     * @param string $attribute
     * @return Model
    */
    public function findBy($attribute, $value): ?Model;

    /**
     * @param array $attributes
     * @param int $id
     * @return Model
    */
    public function update($attributes, $id): ?Model;

    /**
     * @param array $attributes
     * @param array $values
     * @return Model
    */
    public function updateOrCreate($attributes, $values): ?Model;

    /**
     * @param $id
     * @return bool
    */
    public function delete($id): ?bool;
}