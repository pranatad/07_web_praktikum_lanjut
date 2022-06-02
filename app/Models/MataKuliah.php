<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Mahasiswa;

class MataKuliah extends Model
{
    use HasFactory;
    protected $table='matakuliah';

    public function mahasiswa() {
        return $this->hasMany(Mahasiswa::class);
    }
}
