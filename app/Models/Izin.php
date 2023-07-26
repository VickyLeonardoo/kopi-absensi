<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Izin extends Model
{
    use HasFactory;
    protected $guarded = ['id'];

    public function keterangan(){
        return $this->belongsTo(Keterangan::class);
    }

    public function user(){
        return $this->belongsTo(User::class);
    }
}
