<?php

namespace App\CabinetParentsComponent;
use App\MainComponent\Locality as Base;

use Illuminate\Database\Query\Builder;

class Locality extends Base
{
    protected $with = ['locality'];


    public function locality()
    {
        return $this->hasOne(Locality::class, 'id', 'locality_id');
    }

    public function schools()
    {
        return $this->hasMany(School::class, 'id', 'locality_id');
    }

    public function admins()
    {
        return $this->hasMany(Admin::class, 'id', 'locality_id');
    }

//    protected function newBaseQueryBuilder()
//    {
//        $connection = $this->getConnection();
//
//        $query = new Builder(
//            $connection, $connection->getQueryGrammar(), $connection->getPostProcessor(), $this
//        );
//
//        $query->where('locality_id', null);
//
//        return $query;
//    }
}
