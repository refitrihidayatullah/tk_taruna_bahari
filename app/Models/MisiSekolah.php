<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MisiSekolah extends Model
{
    use HasFactory;
    protected $fillable = 'isi_misi';
    protected $table = 'tb_misi';
    protected $primaryKey = 'id_misi';
}
