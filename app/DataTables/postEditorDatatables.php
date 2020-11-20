<?php

namespace App\DataTables;

use App\Models\post;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class postEditorDatatables extends DataTablesEditor
{
    protected $model = post::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
            'title' => 'required',
            'actor_id'  => 'required',
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
            'title' => 'sometimes|required',
            'actor_id'  => 'sometimes|required',
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
