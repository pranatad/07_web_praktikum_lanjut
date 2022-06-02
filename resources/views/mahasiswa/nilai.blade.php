@extends('mahasiswa.layout')
@section('content')
    <div class="row">
        <div class="col-lg-12 margin-tb">
            <div class="pull-left mt-2">
            <h2>JURUSAN TEKNOLOGI INFORMASI-POLITEKNIK NEGERI MALANG</h2>
            </div>
        </div>
    </div>

	<br/>
    <table class="table table-bordered">
        <tr>
        <th>Mata Kuliah</th>
        <th>SKS</th>
        <th>Semester</th>
        <th>Nilai</th>
        </tr>
    @foreach ($matakuliah as $mtk)
        <tr>
        <td>{{ $mtk ->nama_matkul }}</td>
        <td>{{ $mtk ->sks }}</td>
        <td>{{ $mtk ->semester }}</td>
        <td>{{ $mtk ->nilai}}</td>
        <td>
        </td>
        </tr>
@endforeach
    </table>
    <div class="d-flex justify-content-center">

</div>
    @endsection

