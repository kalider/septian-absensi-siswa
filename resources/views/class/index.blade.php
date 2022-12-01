@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
    <a href="/class/create" class="btn btn-primary">Tambah Kelas</a>
</div>

@if(request()->session()->has('success'))
    <div class="alert alert-success">{{request()->session()->get('success')}}</div>
@endif
@if(request()->session()->has('error'))
    <div class="alert alert-danger">{{request()->session()->get('error')}}</div>
@endif
<div class="row">
    <div class="col-lg-4">
        <form>
            <div class="input-group mb-3">
                <input type="search" class="form-control" name="q" value="{{ request()->input('q') }}" placeholder="Filter ..." aria-label="Filter ..."
                    aria-describedby="button-addon2">
                <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
        </form>
    </div>
</div>

<table class="table table-striped">
    <thead>
        <tr>
            <th>ID</th>
            <th>Nama Kelas</th>
            <th>Jurusan</th>
            <th>Wali Kelas</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($classs as $class)
            <tr>
                <td>{{$class->id}}</td>
                <td>{{$class->name_class}}</td>
                <td>{{$class->department}}</td>
                <td>{{$class->wali_class}}</td>
                <td>
                    <a href="{{ url("/class/{$class->id}/edit") }}" class="btn btn-primary btn-sm">Edit</a>
                    <form class="d-inline" action="{{ url("/class/{$class->id}/delete") }}" method="post" onSubmit="return confirm('Apakah anda yakin menghapus pelanggan ini?')">
                        @csrf
                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                    </form>
                </td>

            </tr>
        @empty
            <tr>
                <td colspan="4">Kelas belum tersedia</td>
            </tr>
        @endforelse
    </tbody>
</table>

{{$classs->appends(request()->query())->links()}}

@endsection
