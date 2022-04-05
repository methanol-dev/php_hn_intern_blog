<?php

namespace App\Repositories;

interface RepositoryInterface
{
    /**
     * Get all
     * @return mixed
     */
    public function getAll();

    /**
     * Get one
     * @param $id
     * @return mixed
     */
    public function find(int $id);

    /**
     * Create
     * @param array $attributes
     * @return mixed
     */
    public function create(array $attributes);

    /**
     * Update
     * @param $id
     * @param array $attributes
     * @return mixed
     */
    public function update(int $id, array $attributes);

    /**
     * Delete
     * @param $id
     * @return mixed
     */
    public function delete(int $id);

    /**
     * findOrFail
     * @param $id
     * @return mixed
     */
    public function findOrFail(int $id);
}
