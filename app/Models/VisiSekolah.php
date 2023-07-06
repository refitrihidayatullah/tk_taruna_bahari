<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VisiSekolah extends Model
{
    use HasFactory;
    protected $fillable = 'isi_visi';
    protected $table = 'tb_visi';
    protected $primaryKey = 'id_visi';
}
