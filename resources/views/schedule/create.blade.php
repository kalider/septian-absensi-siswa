@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<form method="post" action="/schedule/create">
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
                <label for="dayInput" class="form-label">Hari</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="day" id="day1Radio" value="1" @checked(old('day') == 1)>
                        <label class="form-check-label" for="day1Radio">Senin</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="day" id="day2Radio" value="2" @checked(old('day') == 2)>
                        <label class="form-check-label" for="day2Radio">Selasa</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="day" id="day3Radio" value="3" @checked(old('day') == 3)>
                        <label class="form-check-label" for="day3Radio">Rabu</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="day" id="day4Radio" value="4" @checked(old('day') == 4)>
                        <label class="form-check-label" for="day4Radio">Kamis</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="day" id="day5Radio" value="5" @checked(old('day') == 5)>
                        <label class="form-check-label" for="day5Radio">Jumat</label>
                    </div>
                </div>
            </div>
            <div class="mb-3">
                <label for="lessonIdSelect" class="form-label">Mata Pelajaran</label>
                <select class="form-control" name="lesson_id" id="lessonIdSelect">
                    <option value="">.: Pilih Mapel :.</option>
                    @foreach ($lessons as $item)
                        <option value="{{ $item->id }}" @selected(old('lesson_id') == $item->id)>{{ $item->name_lesson}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="teacherIdSelect" class="form-label">Guru</label>
                <select class="form-control" name="teacher_id" id="teacherIdSelect">
                    <option value="">.: Pilih Guru :.</option>
                    @foreach ($teachers as $item)
                        <option value="{{ $item->id }}" @selected(old('teacher_id') == $item->id)>{{ $item->name_teacher}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="classIdSelect" class="form-label">Kelas</label>
                <select class="form-control" name="class_id" id="classIdSelect">
                    <option value="">.: Pilih Kelas :.</option>
                    @foreach ($classs as $item)
                        <option value="{{ $item->id }}" @selected(old('class_id') == $item->id)>{{ $item->name_class}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="timeInput" class="form-label">Waktu</label>
                <input type="text" class="form-control" id="timeInput" placeholder="00:00-00:00" name="time" value="{{old('time')}}">
            </div>
            <div class="mb-3">
                <label for="time_toInput" class="form-label">Jam Ke</label>
                <input type="text" class="form-control" id="time_toInput" placeholder="1-10" name="time_to" value="{{old('time_to')}}">
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>

@endsection
