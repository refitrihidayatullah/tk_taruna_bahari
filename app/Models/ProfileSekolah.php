<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProfileSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sekolah', 'alamat', 'sambutan', 'visi', 'misi', 'judul_program', 'isi_program'];
    protected $table = 'tb_profile_sekolah';
    protected $primaryKey = 'id_profile_sekolah';
}
