<?php

namespace App\MainComponent\Http\Controllers;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;

class ModelExtendedController extends ModelController
{
    protected $class;
    private $model;

    public function __construct()
    {
        $this->model = new $this->class();
    }

    public function get($id): Model
    {
        return $this->class::find($id);
    }

    public function getAll(): Collection
    {
        return $this->class::all();
    }

    public function getWithOffset($number, $count = 10, $groupBy = [], $orderBy = null): Collection
    {
        $query = DB::table($this->model->getTable());

        if (is_array($groupBy) && count($groupBy) == 2) {
            $query = $query->groupBy($groupBy[0], $groupBy[1]);
        }

        if (is_array($orderBy) && count($orderBy) == 2) {
            $query = $query->orderBy($orderBy[0], $orderBy[1]);
        } else if ($orderBy !== null) {
            $query = $query->orderBy($orderBy);
        }
        $query = $query->offset($number * $count)->limit($count);
        return $query->get();
    }

    public function delete($id): bool
    {
        return $this->class::destroy($id) > 0;
    }

    public function create(array $properties): Model
    {
        return $this->class::create($properties);
    }

    public function createAll(array $array): array
    {
        $result = [];
        foreach ($array as $item) {
            $model = $this->class::create($item);
            if ($model !== null) {
                $result[] = $model;
            }
        }
        return $result;
    }

    public function set(array $properties): bool
    {
        return $this->class::where('id', $properties['id'])->update($properties);
    }

    public function setAll(array $array): bool
    {
        foreach ($array as $item) {
            if ($this->class::where('id', $item['id'])->update($item) === null) {
                return false;
            }
        }
        return true;
    }
}
