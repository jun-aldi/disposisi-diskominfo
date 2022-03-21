<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SuratKeluar extends Model
{
    use HasFactory,SoftDeletes;

    protected $fillable = [
        'bidangs_id',
        'tanggal_surat',
        'isi',
        'surats_id',
        'sifat',
        'no_surat',
        'kepada',
        'filename',
        'users_id',
    ];
    public function bidang()
    {
        return $this->belongsTo(Bidang::class, 'bidangs_id', 'id');
    }
    public function users()
    {
        return $this->belongsTo(User::class, 'users_id', 'id');
    }
    public function surat()
    {
        return $this->belongsTo(Surat::class, 'surats_id', 'id');
    }
}
