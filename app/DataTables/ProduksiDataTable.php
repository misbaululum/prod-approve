<?php

namespace App\DataTables;

use App\Models\Produksi;
use Illuminate\Database\Eloquent\Builder as QueryBuilder;
use Yajra\DataTables\EloquentDataTable;
use Yajra\DataTables\Html\Builder as HtmlBuilder;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Services\DataTable;

class ProduksiDataTable extends DataTable
{
    /**
     * Build the DataTable class.
     *
     * @param QueryBuilder $query Results from query() method.
     */
    public function dataTable(QueryBuilder $query): EloquentDataTable
    {
        return (new EloquentDataTable($query))
            ->addColumn('action', function($row) {
                return '<a href="'. route('produksi.edit', $row->id) .'" class="btn btn-sm btn-primary">Edit</a>';
            })
            ->addIndexColumn()
            ->editColumn('tanggal', function($row) {
                return $row->tanggal->format('d-m-Y');
            })
            ->editColumn('waktu_awal', function($row) {
                return $row->waktu_awal->format('H:i:s');
            })
            ->editColumn('waktu_akhir', function($row) {
                return $row->waktu_akhir->format('H:i:s');
            });
    }

    /**
     * Get the query source of dataTable.
     */
    public function query(Produksi $model): QueryBuilder
    {
        return $model->newQuery();
    }

    /**
     * Optional method if you want to use the html builder.
     */
    public function html(): HtmlBuilder
    {
        return $this->builder()
                ->parameters([
                    'delay' => 1000,
                    'responsive' => true,
                ])
                ->setTableId('produksi-table')
                ->columns($this->getColumns())
                ->minifiedAjax()
                ->orderBy(1)
                ->selectStyleSingle();
    }

    /**
     * Get the dataTable columns definition.
     */
    protected function getColumns()
    {
        return [
            Column::make('DT_RowIndex')->title('#')->orderable(false)->searchable(false),
            Column::make('id')->hidden(),
            Column::make('nomor'),
            Column::make('user_input'),
            Column::make('tanggal'),
            Column::make('nama_produk'),
            Column::make('ukuran_ml'),
            Column::make('ukuran_l'),
            Column::make('penanggung_jawab'),
            Column::make('waktu_awal'),
            Column::make('waktu_akhir'),
            Column::make('downtime'),
            Column::make('total_jam'),
            Column::make('status_approve'),
            Column::computed('action')
                ->exportable(false)
                ->printable(false)
                ->width(60)
                ->addClass('text-center'),
        ];
    }

    /**
     * Get the filename for export.
     */
    protected function filename(): string
    {
        return 'Produksi_' . date('YmdHis');
    }
}
