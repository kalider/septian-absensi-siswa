@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
    <a href="/presence/create" class="btn btn-primary">Tambah Presensi</a>
</div>

@if(request()->session()->has('success'))
    <div class="alert alert-success">{{request()->session()->get('success')}}</div>
@endif
@if(request()->session()->has('error'))
    <div class="alert alert-danger">{{request()->session()->get('error')}}</div>
@endif

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Tanggal</th>
            <th>Guru</th>
            <th>Mapel</th>
            <th>Jadwal Mengajar</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($pres_times as $item)
            <tr>
                <td>{{$item->id}}</td>
                <td>{{$item->date}}</td>
                <td>{{$item->teacher}}</td>
                <td>{{$item->lesson}}</td>
                <td>{{$item->schedule}}</td>
                <td>
                    <a href="{{ url("/presence/{$item->id}/edit") }}" class="btn btn-primary btn-sm">Edit</a>
                    <a href="{{ url("/presence/{$item->id}/pres") }}" class="btn btn-info btn-sm">Presesnsi Detail</a>
                    <form class="d-inline" action="{{ url("/presence/{$item->id}/delete") }}" method="post" onSubmit="return confirm('Apakah anda yakin menghapus presensi ini?')">
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="7">Siswa belum tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{$pres_times->links()}}

@endsection
