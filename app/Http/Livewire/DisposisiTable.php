<?php

namespace App\Http\Livewire;

use App\Disposisi;
use Mediconesystems\LivewireDatatables\Http\Livewire\LivewireDatatable;
use Mediconesystems\LivewireDatatables\Column;
use Mediconesystems\LivewireDatatables\NumberColumn;
use Mediconesystems\LivewireDatatables\DateColumn;

class DisposisiTable extends LivewireDatatable
{
    public $model = Disposisi::class;

    public function columns()
    {
        return [
            NumberColumn::name('id')
                ->label('ID')
                ->defaultSort('asc')
                ->sortBy('id'),

            Column::name('name')
                ->label('Name'),

            Column::name('email')
                ->label('Email'),

            Column::name('phone')
                ->label('Phone'),

            DateColumn::name('created_at')
                ->label('Created at')
        ];
    }
}
