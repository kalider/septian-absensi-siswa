@extends('layouts.app')

@section('title', $title)

@section('content')
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">{{ $title }}</h1>
    </div>
    @if (request()->session()->has('success'))
        <div class="alert alert-success">{{ request()->session()->get('success') }}</div>
    @endif
    @if (request()->session()->has('error'))
        <div class="alert alert-danger">{{ request()->session()->get('error') }}</div>
    @endif
    <form class="mb-3">
        <div class="row">
            <div class="col-lg-4">
                <select name="class_id" class="form-control" id="classIdInput">
                    @foreach ($allClass as $class)
                    <option value="{{$class->id}}" @selected($class->id == request()->input('class_id'))>{{$class->name_class}}</option>
                    @endforeach
                </select>
            </div>
            <div class="col-lg-4">
                <input type="date" class="form-control" name="date" value="{{ request()->input('date') ?? date('Y-m-d') }}"
                    placeholder="Tanggal...">
            </div>
            <div class="col-lg-4">
                <button class="btn btn-primary" type="submit" id="button-addon2">Cari</button>
            </div>
        </div>
    </form>


    <table class="table table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Nis</th>
                <th>Nama</th>
                @foreach($data['schedules'] as $schedule)
                    <th>{{$schedule->lesson_name}}</th>
                @endforeach
                <th>Hadir</th>
                <th>Sakit</th>
                <th>Izin</th>
                <th>Alpa</th>
                <th>Hadir (%)</th>
            </tr>
        </thead>
        <tbody>
            @forelse ($data['students'] as $student)
                <tr>
                    <td>{{ $student->id }}</td>
                    <td>{{ $student->nis }}</td>
                    <td>{{ $student->name }}</td>
                    @foreach($student->presences as $presence)
                        <td>{{$presence->presenceText}}</td>
                    @endforeach
                    @foreach($student->calcStatus as $calc)
                        <td>{{$calc->total}}</td>
                    @endforeach
                    <td>{{ $student->prosentase }} %</td>
                </tr>
            @empty
                <tr>
                    <td colspan="9">Siswa belum tersedia</td>
                </tr>
            @endforelse
        </tbody>
    </table>

@endsection
