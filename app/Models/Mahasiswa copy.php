<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model; 
use App\Models\Mahasiswa;

class Mahasiswa extends Model 
{
    protected $table='mahasiswa'; 

    protected $primaryKey = 'Nim'; 
    /**
    * The attributes that are mass assignable.
    *
    * @var array
    */
    protected $fillable = [
        'Nim',
        'Nama',
        'Kelas',
        'Jurusan',
        'Email',
        'Alamat',
        'TanggalLahir',
    ];

    public function kelas() {
        return $this->belongsTo(Kelas::class);
    }
};