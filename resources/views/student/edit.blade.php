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
                <label for="nisInput" class="form-label">Nis</label>
                <input type="text" class="form-control" id="nisInput" placeholder="Nis pelanggan" name="nis" value="{{old('nis', $student->nis)}}">
            </div>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Nama Siswa" name="name" value="{{old('name', $student->name)}}">
            </div>
            <div class="mb-3">
                <label for="classIdtSelect" class="form-label">Kelas</label>
                <select class="form-control" name="class_id" id="classIdSelect">
                    <option value="">.: Pilih Kelas :.</option>
                    @foreach ($classs as $item)
                        <option value="{{ $item->id }}" @selected(old('class_id', $student->class_id) == $item->id)>{{ $item->name_class }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="dobInput" class="form-label">Tanggal lahir</label>
                <input type="date" class="form-control" id="dobInput" placeholder="Tanggal lahir" name="dob" value="{{old('dob', $student->dob)}}">
            </div>
            <div class="mb-3">
                <label for="pobInput" class="form-label">Tempat Lahir</label>
                <input type="text" class="form-control" id="pobInput" rows="3" name="pob" value="{{old('pob', $student->pob)}}">
            </div>
            <div class="mb-3">
                <label for="genderInput" class="form-label">Jenis Kelamin</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1Radio" value="1" @checked(old('gender', $student->gender) == 1)>
                        <label class="form-check-label" for="gender1Radio">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2Radio" value="2" @checked(old('gender', $student->gender) == 2)>
                        <label class="form-check-label" for="gender2Radio">Perempuan</label>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Update</button>
            </div>
        </div>
    </div>
</form>

@endsection
