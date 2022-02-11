<?php

namespace App\DataTables;

use App\Models\agenda;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class agendaDataTable extends DataTable
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
            ->addColumn('action', 'agenda.action');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\agenda $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(agenda $model)
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
        ->setTableId('agenda-table')
        ->columns($this->getColumns())
        ->minifiedAjax('api/datatable?class=' . __CLASS__)
        ->dom('Bfrtip')
        ->orderBy(1)
        ->buttons(
            Button::make('create'),
            Button::make('export'),
            Button::make('print'),
            Button::make('reset'),
            Button::make('reload')
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
            Column::make('id'),
            Column::make('disposisi_id'),
            Column::make('jam_agenda'),
            Column::make('tanggal_agenda'),
            Column::make('isi'),
            Column::make('tempat'),
            Column::make('keterangan'),
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'AgendaCrud_' . date('YmdHis');
    }
}
