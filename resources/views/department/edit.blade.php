@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<form method="post" action="{{ url()->current() }}">
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
                <label for="kdInput" class="form-label">Kode Jurusan</label>
                <input type="text" class="form-control" id="kdInput" placeholder="Kode Jurusan" name="kd" value="{{old('kd', $department->kd)}}">
            </div>
            <div class="mb-3">
                <label for="name_departmentInput" class="form-label">Nama Jurusan</label>
                <input type="text" class="form-control" id="name_departmentInput" placeholder="Nama Jurusan" name="name_department" value="{{old('name_department', $department->name_department)}}">
            </div>
            <div class="mb-3">
                <label for="name_leader_departmentInput" class="form-label">Ketua Jurusan</label>
                <input type="text" class="form-control" id="name_leader_departmentInput" placeholder="Ketua Jurusan" name="name_leader_department" value="{{old('name_leader_department', $department->name_leader_department)}}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>

@endsection
