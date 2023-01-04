<?php

namespace App\Repositories;

use App\Models\Permission;
use Illuminate\Support\Collection;

class PermissionRepository extends BaseRepository
{
    /**
     * @param Permission $model
     */
    public function __construct(Permission $model)
    {
        parent::__construct($model);
    }

    /**
    * @return Collection
    */
    public function all(): Collection
    {
        return $this->model->all();
    }
}