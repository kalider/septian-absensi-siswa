@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
    <a href="/department/create" class="btn btn-primary">Tambah Jurusan</a>
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
            <th>Kode Jurusan</th>
            <th>Nama Jurusan</th>
            <th>Ketua Jurusan</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($departments as $department)
            <tr>
                <td>{{$department->id}}</td>
                <td>{{$department->kd}}</td>
                <td>{{$department->name_department}}</td>
                <td>{{$department->name_leader_department}}</td>
                <td>
                    <a href="{{ url("/department/{$department->id}/edit") }}" class="btn btn-primary btn-sm">Edit</a>
                    <form class="d-inline" action="{{ url("/department/{$department->id}/delete") }}" method="post" onSubmit="return confirm('Apakah anda yakin menghapus siswa ini?')">
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr>
                <td colspan="5">Jurusan belum tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{$departments->links()}}

@endsection
