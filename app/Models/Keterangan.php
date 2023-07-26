<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keterangan extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function izin(){
        return $this->hasMany(Izin::class);
    }
}
