<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mitra extends Model
{
    use HasFactory;
    protected $table = 'mitras';
    protected $primaryKey = 'id';

    protected $fillable = [
        'name',
        'namaAdminPt',
        'jk',
        'notelp',
        'email',
    ];
}
