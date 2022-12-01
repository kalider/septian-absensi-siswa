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
                <label for="name_classInput" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="name_classInput" placeholder="Nama Kelas" name="name_class" value="{{old('name_class', $class->name_class)}}">
            </div>
            <div class="mb-3">
                <label for="departmenIdtSelect" class="form-label">Jurusan</label>
                <select class="form-control" name="department_id" id="departmentIdSelect">
                    <option value="">.: Pilih Jurusan :.</option>
                    @foreach ($departments as $item)
                        <option value="{{ $item->id }}" @selected(old('department_id', $class->department_id) == $item->id)>{{ $item->name_department }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="wali_classInput" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="wali_classInput" placeholder="Wali Kelas" name="wali_class" value="{{old('wali_class', $class->wali_class)}}">
             <br>
            <div>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>

@endsection
