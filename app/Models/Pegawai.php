<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Pegawai extends Model
{
    use HasFactory;
    protected $table = 'pegawai';
    protected $fillable = ['nama','umur','jabatan'];
    protected static function booted(){
        static::creating(function ($model) {
            $model->created_at = Carbon::now();
            $model->updated_at = Carbon::now();
        });
        static::saving(function ($model) {
            $model->updated_at = Carbon::now();
        });
    }

}
