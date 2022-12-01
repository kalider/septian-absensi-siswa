@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
    <a href="/lesson/create" class="btn btn-primary">Tambah Mata Pelajaran</a>
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
            <th>Kode Mapel</th>
            <th>Nama Mapel</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($lessons as $lesson)
        <tr>
            <td>{{$lesson->id}}</td>
            <td>{{$lesson->kd_lesson}}</td>
            <td>{{$lesson->name_lesson}}</td>
            <td>
                <a href="{{ url("/lesson/{$lesson->id}/edit") }}" class="btn btn-primary btn-sm">Edit</a>
                <form class="d-inline" action="{{ url("/lesson/{$lesson->id}/delete") }}" method="post" onSubmit="return confirm('Apakah anda yakin menghapus pelanggan ini?')">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="4">Mata Pelajaran belum tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{$lessons->links()}}

@endsection