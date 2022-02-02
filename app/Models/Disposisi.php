<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Disposisi extends Model
{
    use HasFactory,SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    public $table = "disposisi";
    protected $fillable = [
        'dari',
        'tanggal_dibuat',
        'no_surat',
        'isi_surat',
        'no_agenda',
        'tanggal_diterima',
        'kepada',
        'status_id',
        'users_id',

    ];

    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function status()
    {
        return $this->belongsTo(Status::class, 'status_id', 'id');
    }
    public function agenda_disposisi()
    {
        return $this->hasOne(Agenda::class, 'disposisi_id', 'id');
    }

}
