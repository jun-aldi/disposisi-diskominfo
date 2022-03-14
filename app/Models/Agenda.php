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
        'disposisis_id',
        'jam_agenda',
        'tanggal_agenda',
        'isi',
        'bidangs_id',
        'tempat',
        'keterangan',
    ];

    public function disposisi()
    {
        return $this->hasOne(Disposisi::class, 'id', 'disposisis_id');
    }
    public function bidang()
    {
        return $this->hasOne(Bidang::class, 'id', 'bidangs_id');
    }

    Use Sortable;
    protected $sortable = [
        'id',
        'disposisis_id',
        'bidangs_id',
        'jam_agenda',
        'tanggal_agenda',
        'isi',
        'tempat',
        'keterangan',
    ];
}
