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
                <label for="kd_lessonInput" class="form-label">Nama Kelas</label>
                <input type="text" class="form-control" id="kd_lessonInput" placeholder="Nama Kelas" name="kd_lesson" value="{{old('kd_lesson', $lesson->kd_lesson)}}">
            </div>
            <div class="mb-3">
                <label for="name_lessonInput" class="form-label">Wali Kelas</label>
                <input type="text" class="form-control" id="name_lessonInput" placeholder="Wali Kelas" name="name_lesson" value="{{old('name_lesson', $lesson->name_lesson)}}">
             <br>
            <div>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>

@endsection
