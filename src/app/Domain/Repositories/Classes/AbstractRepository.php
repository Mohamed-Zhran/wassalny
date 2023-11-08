<?php

declare(strict_types=1);

namespace App\Domain\Repositories\Classes;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class AbstractRepository
{
    /**
     *
     * @param Model $model
     */
    public function __construct(protected Model $model)
    {
    }
    /**
     *
     * @return Collection
     */
    public function findAll(): Collection
    {
        return $this->model->all();
    }
    /**
     *
     * @param integer $id
     * @return Model|null
     */
    public function findById(int $id): ?Model
    {
        return $this->model->findOrFail($id);
    }
    /**
     *
     * @param array $data
     * @return Model
     */
    public function create(array $data): Model
    {
        return $this->model->create($data);
    }
    /**
     *
     * @param integer $id
     * @param array $data
     * @return Model
     */
    public function update(int $id, array $data): Model
    {
        return $this->model->find($id)->update($data);
    }
    /**
     *
     * @param integer $id
     * @return boolean
     */
    public function delete(int $id): bool
    {
        return $this->model->find($id)->delete();
    }
}
