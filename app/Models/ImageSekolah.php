<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageSekolah extends Model
{
    use HasFactory;
    protected $fillable = ['image'];
    protected $table = 'tb_galeri';
    protected $primaryKey = 'id_galeri';
}
