<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Agenda extends Model
{
        use HasFactory,SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'disposisi_id',
        'jam_agenda',
        'tanggal_agenda',
        'isi',
        'tempat',
        'keterangan',
    ];

    public function disposisi_agenda()
    {
        return $this->hasOne(Disposisi::class, 'disposisi_id', 'id');
    }

    Use Sortable;
    protected $sortable = [
        'id',
        'disposisi_id',
        'jam_agenda',
        'tanggal_agenda',
        'isi',
        'tempat',
        'keterangan',
    ];
}
