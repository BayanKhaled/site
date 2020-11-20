<?php

namespace App\DataTables;

use App\Models\actor;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class actorEditorDatatables extends DataTablesEditor
{
    protected $model = actor::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'email' => 'required|email|unique:' . $this->resolveModel()->getTable(),
            'name'  => 'required',
        ];
    }

    /**
     * Get edit action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function editRules(Model $model)
    {
        return [
            'name'  => 'sometimes|required',
            'email' => 'sometimes|required|email',
        ];
    }

    /**
     * Get remove action validation rules.
     *
     * @param Model $model
     * @return array
     */
    public function removeRules(Model $model)
    {
        return [];
    }


    public function creating(Model $model, array $data)
    {
        // $data['password'] = bcrypt($data['password']);

        return $data;
    }



     public function updating(Model $model, array $data)
    {

        return $data;
    }
}
