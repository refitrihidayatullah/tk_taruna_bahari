<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgramSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['judul_program', 'isi_program'];
    protected $table = 'tb_program';
    protected $primaryKey = 'id_program';
}
