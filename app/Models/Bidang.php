<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Bidang extends Model
{
    use HasFactory,SoftDeletes;

        /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
    ];

    public function disposisi_bidang()
    {
        return $this->hasMany(Disposisi::class, 'bidangs_id', 'id');
    }

    public function Surat_masuk_bidang()
    {
        return $this->hasMany(SuratMasuk::class, 'bidangs_id', 'id');
    }
    public function agenda_bidang()
    {
        return $this->hasMany(Agenda::class, 'bidangs_id', 'id');
    }
}
