@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
    <a href="/schedule/create" class="btn btn-primary">Tambah Jadwal</a>
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
            <th>Hari</th>
            <th>Mata Pelajaran</th>
            <th>Nama Guru</th>
            <th>Kelas</th>
            <th>Waktu</th>
            <th>Jam Ke</th>
            <th>&nbsp;</th>
        </tr>
    </thead>
    <tbody>
        @forelse ($schedules as $schedule)
        <tr>
            <td>{{$schedule->id}}</td>
            <td>{{$schedule->day}}</td>
            <td>{{$schedule->lesson}}</td>
            <td>{{$schedule->teacher}}</td>
            <td>{{$schedule->class}}</td>
            <td>{{$schedule->time}}</td>
            <td>{{$schedule->time_to}}</td>
            <td>
                <a href="{{ url("/schedule/{$schedule->id}/edit") }}" class="btn btn-primary btn-sm">Edit</a>
                <form class="d-inline" action="{{ url("/schedule/{$schedule->id}/delete") }}" method="post" onSubmit="return confirm('Apakah anda yakin menghapus pelanggan ini?')">
                    @csrf
                    <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                </form>
            </td>
        </tr>
        @empty
        <tr>
            <td colspan="7">Jadwal Mengajar belum tersedia</td>
        </tr>
        @endforelse
    </tbody>
</table>

{{$schedules->links()}}

@endsection