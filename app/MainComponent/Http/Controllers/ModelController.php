<?php

namespace App\MainComponent\Http\Controllers;


use Illuminate\Support\Collection;
use Illuminate\Database\Eloquent\Model;

abstract class ModelController
{
    public abstract function get($id): Model;

    public abstract function getAll(): Collection;

    public abstract function getWithOffset($number, $count = 10, $groupBy = [], $orderBy = null): Collection;

    public abstract function delete($id): bool;

    public abstract function create(array $properties): Model;

    public abstract function createAll(array $array): array;

    public abstract function set(array $properties): bool;

    public abstract function setAll(array $array): bool;
}
