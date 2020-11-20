<?php

namespace App\DataTables;

use App\Models\members;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class membersDatatables extends DataTable
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
            // ->addColumn('action');
    }



    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\members $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(members $model)
    {
        // return $model->newQuery();
        return $model->query();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    
/*
    public function html()
    {
        return $this->builder()
                    ->setTableId('membersdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1)
                    ->buttons(
                        Button::make('create'),
                        Button::make('export'),
                        Button::make('print'),
                        Button::make('reset'),
                        Button::make('reload')
                    );
    }*/
    
    public function html()
    {
        return $this->builder()
                    ->setTableId('membersdatatables-table')
                    ->columns($this->getColumns())
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->pageLength(15)
                    ->lengthMenu([ [10, 25, 50, 100, -1], [10, 25, 50, 100, 'All'] ])
                    ->pagingType('full')
                    ->parameters([
                      // 'dom' => 'Blfrtip',
                      'dom' => '<"float-left"B><"float-right"f>rt<"row"<"col-sm-4"l><"col-sm-4"i><"col-sm-4"p>>',
                      'select' => [
                          // 'style' => 'os',
                          'style' => 'multi',
                          'selector' => 'td:first-child',
                      ],
                      /*'buttons' => ['csv', 'excel', 'pdf',
                                      [
                                          "extend" => 'selectAll',
                                          "text" => 'Print current page',
                                      ],
                                    ],*/
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
                            // 'pageLength': 25,
                            // 'lengthMenu': [ [10, 25, 50, -1], [10, 25, 50, 'All'] ]
                      // Button::make('reload'),
                      // Button::make('pdf'),
                      // Button::make('reset'),
                      // Button::make('create')->editor('editor')->text('create'),
                    );
                    /*->buttons(
                        Button::make(['copy'])->text('aaaa')->action('alert("hi")'),
                        Button::make(['copy'])->text('action')->action('function() { this.submit(); }'),
                        Button::make(['copy'])->extend('collection')->text('Save as Excel')->action("function ( dt ) {
                            console.log( 'My custom button!' );
                        }"),
                        Button::make(['copy'])->extend('collection')->text('Save as')->buttons([
                              Button::make(['copy'])->text('CSV')->action("function () { this.close();}"),
                              Button::make(['copy'])->text('PDF')->action("function () { this.close();}"),
                            ]),
                        Button::make(['copy'])->extend('selected')->text('Duplicate')->action("function ( e, dt, node, config ) {
                                        var table = $('#members').DataTable();
                                        editor.edit( table.rows( {selected: true} ).indexes(), {
                                              title: 'Duplicate record',
                                               buttons: 'Create from existing'
                                          } ).mode('edit');
                                      }"),
                                        
                        Button::make('create')->editor('editor')->text('create'),//->formButtons(['label' => 'Cancel222',]),
                        Button::make('edit')->editor('editor')->text('edit')->formMessage('Enter the data for the new row and click the "Save" button.'),
                        Button::make('editSingle')->editor('editor')->text('editSingle')->formButtons([
                        'Edit',Button::make(['copy'])->text('Cancel')->action("function () { this.close();}"),]),

                        Button::make('remove')->editor('editor')->text('remove'),
                        Button::make('removeSingle')->editor('editor')->text('removeSingle'),
                        // Button::make('bubble')->editor('editor'),
                        Button::make(['copy'])->extend('collection')->text('Csv')->action('print'),

                    )*/

                      /*'buttons' =>[
                                      'excel',
                                      'selectAll',
                                      'selectNone',
                                      [
                                          "extend" => 'excel',
                                          "text" => 'Print current page',
                                          "autoPrint" => false
                                      ],
                                  ],*/
                      // page( 'next' ).draw( 'page' )
                      // 'paging' => false,
                    
                    /*->buttons(
                        Button::make(['copy'])->extend('collection')->text('Csv')->action('print'),
                        Button::make('csv'),
                        Button::make('excel')
                    );*/



                        // buttons: ['selectAll', 'selectNone','excel', 'csv', 'pdf', 'copy'],
                        // 'buttons' => ['postExcel', 'postCsv', 'postPdf'],
                        // 'buttons' => ['reset'],
                        // 'buttons' => ['reload'],




                      /*'buttons'      => [
                            ['extend' => 'create' , 'editor' => 'editor'],
                            ['extend' => 'edit' , 'editor' => 'editor'],
                            ['extend' => 'remove' , 'editor' => 'editor'],
                            ['extend' => 'selected', 'editor' => 'editor'],
                      ],*/
                    //->dom('Bfrtip')
                    // ->orderBy(1)
                    /*->parameters([
                        'dom' => 'Bfrtip',
                        'orderBy' => [1, 'asc'],
                        'select' => [
                            'style' => 'os',
                            'selector' => 'td:first-child',
                        ],
                        'paging' => true,
                        'searching' => true,
                        'info' => false,
                        'searchDelay' => 350,
                        'buttons'      => [
                            ['extend' => 'create' , 'editor' => 'editor'],
                            ['extend' => 'edit' , 'editor' => 'editor'],
                            ['extend' => 'remove' , 'editor' => 'editor'],
                        ],
                    ]);*/
                    /*
                    ->buttons(
                        Button::make('create')->editor('editor'),
                        Button::make('edit')->editor('editor'),
                        Button::make('remove')->editor('editor'),
                    )*/
            
                    // editor.edit( table.rows( {selected: true} ).indexes(), {} ).mode( 'create' );
                        

                        // extend: "selected",
                        // text: 'Duplicate',
                        // action: function ( e, dt, node, config ) {
                        //     // Start in edit mode, and then change to create
                        //     editor
                        //         .edit( table.rows( {selected: true} ).indexes(), {
                        //             title: 'Duplicate record',
                        //             buttons: 'Create from existing'
                        //         } )
                        //         .mode( 'create' );
                        // }

// var table = $('#members').DataTable();

// new function() {
// $('#members').DataTable( {
//     rows( {selected: true} ).indexes()
// } );
// }

                        // table: "#members",
                        // editor.edit( table.rows( {selected: true} ).indexes(), {
                        //     title: 'Duplicate record',
                        //     buttons: 'Create from existing'
                        // } ).mode( 'create' );
        
    }
    


    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            /*Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),*/
            Column::checkbox('id')->title('#')->width('15px')->exportable(false)->printable(false)->orderable(false)->searchable(false)->orderable(false),
            Column::make('id'),
            Column::make('name'),
            Column::make('email'),
            Column::make('Go')->render('function(){return "hiii";}')->exportable(false)->printable(false)->orderable(false)->searchable(false)->orderable(false),
        ];

        /*return [
            Column::computed('action')
                  ->exportable(false)
                  ->printable(false)
                  ->width(60)
                  ->addClass('text-center'),
            Column::make('id'),
            Column::make('add your columns'),
            Column::make('created_at'),
            Column::make('updated_at'),
        ];*/
        /*
        [
            'defaultContent' => '<input type="checkbox"/>',
            'title'          => 'Checkbox',
            'data'           => 'checkbox',
            'name'           => 'checkbox',
            'orderable'      => false,
            'searchable'     => false,
            'exportable'     => false,
            'printable'      => true,
            'width'          => '10px',
        ]
        */
        
        /*return [
            [
                'data'           => null,
                'defaultContent' => '<input type="checkbox"/>',
                'ClassName'          => 'select-checkbox',
                'title'          => '#',
                'orderable'      => false,
                'searchable'     => false,
            ],
            'id',
            'name',
            'email',
        ];*/
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'membersDatatables_' . date('YmdHis');
    }
}
