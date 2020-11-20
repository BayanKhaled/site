<?php

namespace App\DataTables;

use App\Models\post;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;
use URL;

class postDatatables extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->setRowId('id');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\post $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(post $model)
    {
        return $model->query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('postdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->pageLength(15)
                    ->lengthMenu([ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'] ])
                    ->pagingType('full')
                    ->parameters([
                        'dom' => '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                        // 'select' => [
                        //     'style' => 'multi',
                        //     'selector' => 'td:first-child',
                        // ],
                    ])
                    ->buttons(
                        Button::make(['copy'])->extend('collection')->text('Save as ..')->buttons([
                          Button::make('csv'),
                          Button::make('excel'),
                        ]),
                        Button::make('print'),
                        Button::make('selectAll'),
                        Button::make('selectNone'),

                        Button::make('New')->extend('collection')->text('New')->className("btn-primary")
                        ->action("function () {
                        editor.create({buttons: [ 'Save']});
                        }")
                        ->formButtons(['Edit']),

                        Button::make('editSingle')->editor('editor')->text('edit')->formButtons([
                        'Edit',
                        Button::make(['copy'])->text('Cancel')->className("primary")->action("function () { this.close();}"),]),
                        Button::make('removeSingle')->editor('editor')->text('Remove'),
                        Button::make('remove')->editor('editor')->text('MultiRemove'),
                        Button::make('create')->editor('editor')->text('create'),
                        Button::make('edit')->editor('editor')->text('edit')
                        ->action("function () {
                        window.location.replace('" . URL::current() . "');
                        }"),
                        Button::make(['copy'])->editor('editor')->text('show')
                        ->action("function () {
                        window.location.replace('" . URL::current() . "');
                        }"),
                    );
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                "className"=>     'details-control',
                "orderable"=>      false,
                "data" =>           null,
                "defaultContent"=> '',
                "title" => '',
            ],
            // Column::checkbox('id')->title('#')->width('15px')->exportable(false)->printable(false)->orderable(false)->searchable(false)->orderable(false),
            Column::make('id'),
            Column::make('title'),
            Column::make('actor_id'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'postDatatables_' . date('YmdHis');
    }
}
