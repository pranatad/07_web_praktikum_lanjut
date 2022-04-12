<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class MahasiswaController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        $cari = Mahasiswa::latest();
        if(request('search')) {
            $cari->where('nama', 'like', '%' . request('search') . '%');
        }
       
        $mahasiswa = $mahasiswa = DB::table('mahasiswa')->paginate(3)->withQueryString(); 
        $posts = Mahasiswa::orderBy('Nim', 'desc')->paginate(6);
        return view('mahasiswa.index', compact('mahasiswa'), [
            "cari" => $cari->get()
        ]);
        with('i', (request('search')->input('page', 1) - 1) * 5);
        return view('cari', [
            "cari" => $cari->get() 
        ]);
    }
    public function create()
    {
        return view('mahasiswa.create');
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

    Mahasiswa::create($request->all());
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Ditambahkan');
    }
    public function show($Nim)
    {

    //$Mahasiswa = Mahasiswa::find($Nim);
    $Mahasiswa = Mahasiswa::where('nim', $Nim)->firstOrFail();
    return view('mahasiswa.detail', compact('Mahasiswa'));
    }
    public function edit($Nim)
    {

    $Mahasiswa = DB::table('mahasiswa')->where('nim', $Nim)->first();;
    return view('mahasiswa.edit', compact('Mahasiswa'));
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

    //Mahasiswa::find($Nim)->update($request->all());
    $Mahasiswa = Mahasiswa::where('nim', $Nim)->firstOrFail()->update($request->all());
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Diupdate');
    }
    public function destroy($Nim)
    {

    //Mahasiswa::find($Nim)->delete();
    $Mahasiswa = Mahasiswa::where('nim', $Nim)->firstOrFail()->delete();
    return redirect()->route('mahasiswa.index')->with('success', 'Mahasiswa Berhasil Dihapus');
  }

};