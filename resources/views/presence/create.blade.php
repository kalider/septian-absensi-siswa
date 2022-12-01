@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<form method="post" action="/presence/create">
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
                <label for="dateInput" class="form-label">Tanggal</label>
                <input type="date" class="form-control" id="dateInput" placeholder="Tanggal" name="date" value="{{old('name')}}">
            </div>
            <div class="mb-3">
                <label for="scheduleIdSelect" class="form-label">Kelas</label>
                <select class="form-control" name="schedule_id" id="scheduleIdSelect">
                    <option value="">.: Pilih Jam Mengajar :.</option>
                    @foreach ($schedules as $item)
                        <option value="{{ $item->id }}" @selected(old('schedule_id') == $item->id)>{{ $item->time_to}}</option>
                    @endforeach
                </select>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Simpan</button>
            </div>
        </div>
    </div>
</form>

@endsection
