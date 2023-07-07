<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SosmedSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['nama_sosmed', 'link_sosmed'];
    protected $table = 'tb_sosmed';
    protected $primaryKey = 'id_sosmed';
}
