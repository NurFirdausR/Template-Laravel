<?php

namespace App\Repositories;

use App\Models\Model;
use App\Models\User;
use Illuminate\Support\Collection;

class UserRepository
{
    /**
     * @var User
     */
    protected $model;

    /**
     * @var string
     */
    public $defaultLevel = 'registered';

    /**
     * @var int
     */
    protected $paginate = 25;

    /**
     * @param User $model
     */
    public function __construct(User $model)
    {
        $this->model = $model;
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function all($attributes = [])
    {
        return $this->model
            ->when(isset($attributes['role']) && $attributes['role'] != "", function ($query) use ($attributes) {
                $query->whereHas('roles', fn ($query) => $query->where('name', $attributes['role']));
            })
            ->orderBy('name')
            ->get();
    }

    /**
     * @param array $attributes
     * @return mixed
     */
    public function getUserHasRole($attributes = [])
    {
        return $this->model
            ->whereHas('roles')
            ->get();
    }

    /**
     * Register new user
     *
     * @param array $attributes
     * @return Model
     */
    public function register(array $attributes): Model
    {
        $user = $this->model->create($attributes);
        $user->assignRole($attributes['level']);

        return $user;
    }

    /**
     * @param string|array $roles
     * @param int $userId
     * @return Model
     */
    public function syncRoles($roles, $userId): Model
    {
        $user = $this->model->find($userId);
        $user->syncRoles($roles);

        return $user;
    }

    /**
     * @param array $attributes
     * @return User
     */
    public function create(array $attributes): User
    {
        return $this->model->create($attributes);
    }

    /**
     * @param int $id
     * @return null|User
     */
    public function find($id): ?User
    {
        return $this->model->find($id);
    }

    /**
     * @param string $attribute
     * @return null|User
     */
    public function findBy($attribute, $value): ?User
    {
        return $this->model->where($attribute, $value)->first();
    }

    /**
     * @param array $attributes
     * @param int $id
     * @return null|User
     */
    public function update($attributes, $id): ?User
    {
        $model = $this->find($id);
        $model->update($attributes);

        return $model;
    }

    /**
     * @param array $attributes
     * @param array $values
     * @return null|User
     */
    public function updateOrCreate($attributes, $values): ?User
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
     * @param   Array
     * @return  Collection
     */
    public function getWhere(array $attr = [
        ['column' => '', 'operator' => '', 'value' => '']
    ]): Collection
    {
        $data = $this->model
            ->select(
                'users.*'
            );

        foreach ($attr as $item) {
            $data->when($item['value'] != '', function ($w) use ($item) {
                $w->where($item['column'], $item['operator'], $item['value']);
            });
        }
        return $data->get();
    }

    /**
     * @param   Array
     */
    public function firstWhere(array $attr = [
        ['column' => '', 'operator' => '', 'value' => '']
    ])
    {
        $data = $this->model
            ->select(
                'users.*'
            );

        foreach ($attr as $item) {
            $data->when($item['value'] != '', function ($w) use ($item) {
                $w->where($item['column'], $item['operator'], $item['value']);
            });
        }
        return $data->first();
    }
}
