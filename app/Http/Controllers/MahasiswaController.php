<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Kelas;
use App\Models\Mahasiswa_MataKuliah;
use App\Models\MataKuliah;

class MahasiswaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $mahasiswa = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('id_mahasiswa','asc')->paginate(3);
        return view('mahasiswa.index', ['mahasiswa' => $mahasiswa,'paginate'=>$paginate]);
    
    }
    public function create()
    {
        $kelas = Kelas::all();
        return view('mahasiswa.create',['kelas' => $kelas]);

    }

    public function nilai()
    {
       $mahasiswa_matakuliah = Mahasiswa_Matakuliah::with('mahasiswa_matakuliah')->get();
        return view('mahasiswa.nilai');
    
    }

    public function store(Request $request)
    {

    $request->validate([
        'Nim' => 'required',
        'Nama' => 'required',
        'Kelas' => 'required',
        'Jurusan' => 'required',
        'Email' => 'required',
        'Alamat' => 'required',
        'TanggalLahir' => 'required',
    ]);

    $mahasiswa = new Mahasiswa;
    $mahasiswa->nim = $request->get('Nim');
    $mahasiswa->nama = $request->get('Nama');
    $mahasiswa->jurusan = $request->get('Jurusan');
    $mahasiswa->kelas_id = $request->get('Kelas');
    $mahasiswa->email = $request->get('Email');
    $mahasiswa->alamat = $request->get('Alamat');
    $mahasiswa->tanggallahir = $request->get('TanggalLahir');
    $mahasiswa->save();

    $kelas = new Kelas;
    $kelas->kelas_id = $request->get('Kelas');

    $mahasiswa->kelas()->associate($kelas);
    $mahasiswa->save();
    


    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');

    }
    public function show($Nim)
    {
        $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        return view('mahasiswa.detail', ['Mahasiswa' => $mahasiswa]);
   
    }
    public function edit($Nim)
    {
    $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
    $kelas = Kelas::all();
    return view('mahasiswa.edit', compact('mahasiswa','kelas'));
   
    }
    public function update(Request $request, $Nim)
    {

    $request->validate([
    'Nim' => 'required',
    'Nama' => 'required',
    'Kelas' => 'required',
    'Jurusan' => 'required',
    'Email' => 'required',
    'Alamat' => 'required',
    'TanggalLahir' => 'required',
    ]);

    $mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
    $mahasiswa->nim = $request->get('Nim');
    $mahasiswa->nama = $request->get('Nama');
    $mahasiswa->jurusan = $request->get('Jurusan');
    $mahasiswa->email = $request->get('Email');
    $mahasiswa->alamat = $request->get('Alamat');
    $mahasiswa->tanggallahir = $request->get('TanggalLahir');
    $mahasiswa->save();

    $kelas = new Kelas;
    $kelas->id = $request->get('Kelas');

    $mahasiswa->kelas()->associate($kelas);
    $mahasiswa->save();

  
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }
    public function destroy($Nim)
    {

    
    $Mahasiswa = Mahasiswa::where('nim', $Nim)->firstOrFail()->delete();
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Dihapus');
  }

};