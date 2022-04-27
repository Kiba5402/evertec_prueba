<?php

namespace App\Repositories;

use Illuminate\Database\Eloquent\Model;

class BaseRepository
{
    protected $model;
    protected $relations;

    public function __construct(Model $model, array $relations = [])
    {
        $this->model     = $model;
        $this->relations = $relations;
    }

    //Retorna todos los registros existentes del modelo
    public function all()
    {
        $query = $this->model;
        
        if (!empty($this->relations)) {
            $query->with($this->relations);
        }

        return $query->get();
    }

    //Retorna un registro especifico del modelo
    public function get(int $id)
    {
        return $this->model->find($id);
    }

    //Retorna un registro especifico del modelo
    public function getBySlug(String $slug)
    {
        return $this->model->findBySlug($slug);
    }

    //Guarda un registro especifico del modelo
    public function save(Model $model)
    {
        $model->save();
        return $model;
    }

    //Elimina un registro especifico del modelo
    public function delete(Model $model)
    {
        $model->delete();
        return $model;
    }
}
