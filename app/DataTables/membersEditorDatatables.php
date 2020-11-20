<?php

namespace App\DataTables;

use App\Models\members;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Validation\Rule;
use Yajra\DataTables\DataTablesEditor;

class membersEditorDatatables extends DataTablesEditor
{
    protected $model = members::class;




    public function createRules()
    {
        return [
            'email' => 'required|email|unique:' . $this->resolveModel()->getTable(),
            'name'  => 'required',
        ];
    }



    public function editRules(Model $model)
    {
        return [
            // 'email' => 'sometimes|required|email|' . Rule::unique($model->getTable())->ignore($model->getKey()),
            // 'email' => 'sometimes|required|email|',
            // 'name'  => 'sometimes|required',
            'name'  => 'sometimes|required',
            'email' => 'sometimes|required|email',
        ];
    }




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
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $data['password'] = bcrypt($data['password']);
        }

        return $data;
    }
}
