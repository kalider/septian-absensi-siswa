@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

@if(request()->session()->has('success'))
<div class="alert alert-success">{{request()->session()->get('success')}}</div>
@endif
@if(request()->session()->has('error'))
<div class="alert alert-danger">{{request()->session()->get('error')}}</div>
@endif

<form action="{{ url("/presence/{$presence->id}/pres") }}" method="post">
    @csrf
    
    <div class="row justify-content-center">
        <div class="col-lg-8">
            @if(isset($error))
                <div class="alert alert-danger">{{$error}}</div>
            @endif
            <table class="table table-striped">
                <tbody>
                    <tr>
                        <td width="20%">Tanggal</td>
                        <td>{{$presence->date}}</td>
                    </tr>
                    <tr>
                        <td>Mata pelajaran</td>
                        <td>{{$presence->name_lesson}}</td>
                    </tr>
                    <tr>
                        <td>Guru</td>
                        <td>{{$presence->teacher}}</td>
                    </tr>
                    <tr>
                        <td>Kelas</td>
                        <td>{{$presence->class}}</td>
                    </tr>
                </tbody>
            </table>
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nis</th>
                        <th>Siswa</th>
                        <th colspan="4">Presensi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($students as $student)
                    <tr>
                        <td>{{$student->nis}}</td>
                        <td>
                            {{$student->name}}
                            <input type="hidden" name="press[{{$student->id}}][pres_id]" value="{{$student->pres_id}}">
                        </td>
                        
                        <td>
                            <div class="form-check">
                                <input type="radio" name="press[{{$student->id}}][status]" id="hadirPres{{$student->id}}" value="1" @checked($student->status == 1)>
                                <label class="form-check-label" for="hadirPres{{$student->id}}">
                                    Hadir
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="press[{{$student->id}}][status]" id="sakitPres{{$student->id}}" value="2" @checked($student->status == 2)>
                                <label class="form-check-label" for="sakitPres{{$student->id}}">
                                    Sakit
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="press[{{$student->id}}][status]" id="izinPres{{$student->id}}" value="3" @checked($student->status == 3)>
                                <label class="form-check-label" for="izinPres{{$student->id}}">
                                    Izin
                                </label>
                            </div>
                        </td>
                        <td>
                            <div class="form-check">
                                <input type="radio" name="press[{{$student->id}}][status]" id="alpaPres{{$student->id}}" value="4" @checked($student->status == 4)>
                                <label class="form-check-label" for="alpaPres{{$student->id}}">
                                    Alpa
                                </label>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5">Belum ada data Siswa</td>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <button type="submit" class="btn btn-primary">Simpan</button>
        </div>
    </div>

</form>



@endsection
