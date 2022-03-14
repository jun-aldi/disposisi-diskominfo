<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Kyslik\ColumnSortable\Sortable;

class Disposisi extends Model
{
    use HasFactory,SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $table = "disposisis";
    protected $fillable = [
        'dari',
        'tanggal_dibuat',
        'no_surat',
        'isi_surat',
        'agendas_id',
        'tanggal_diterima',
        'bidangs_id',
        'surats_id',
        'filename',
        'status_id',
        'users_id',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidangs_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function agenda_disposisi()
    {
        return $this->belongsTo(Agenda::class, 'disposisis_id', 'id');
    }
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surats_id', 'id');
    }

    public function getData()
    {
        return static::orderBy('created_at','desc')->get();
    }

    use Sortable;
    public $sortable = [
        'id',
        'dari',
        'tanggal_dibuat',
        'no_surat',
        'isi_surat',
        'no_agenda',
        'tanggal_diterima',
        'bidangs_id',
        'status_id',
        'users_id',

    ];


    public function deleteData($id)
    {
        return static::find($id)->delete();
    }

}
