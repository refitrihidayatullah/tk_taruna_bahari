<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SambutanSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['judul_sambutan', 'isi_sambutan'];
    protected $table = 'tb_sambutan';
    protected $primaryKey = 'id_sambutan';
}
