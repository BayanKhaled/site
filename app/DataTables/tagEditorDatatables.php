<?php

namespace App\DataTables;

use App\Models\tag;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class tagEditorDatatables extends DataTablesEditor
{
    protected $model = tag::class;

    /**
     * Get create action validation rules.
     *
     * @return array
     */
    public function createRules()
    {
        return [
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
