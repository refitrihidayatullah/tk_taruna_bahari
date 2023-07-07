<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InformasiSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['judul_informasi', 'isi_informasi'];
    protected $table = 'tb_informasi';
    protected $primaryKey = 'id_informasi';
}
