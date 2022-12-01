@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<form method="post" action="/teacher/create">
    @csrf
    <div class="row justify-content-center">
        <div class="col-lg-6">
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $item)
                    <li>{{ $item }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            @if(isset($error))
                <div class="alert alert-danger">{{$error}}</div>
            @endif
            <div class="mb-3">
                <label for="nipInput" class="form-label">NIP</label>
                <input type="text" class="form-control" id="nipInput" placeholder="NIP" name="nip" value="{{old('nip')}}">
            </div>
            <div class="mb-3">
                <label for="name_teacherInput" class="form-label">Nama Guru</label>
                <input type="text" class="form-control" id="name_teacherInput" placeholder="Nama Guru" name="name_teacher" value="{{old('name_teacher')}}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </div>
    </div>
</form>

@endsection