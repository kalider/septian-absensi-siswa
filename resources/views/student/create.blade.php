@extends('layouts.app')

@section('title', $title)

@section('content')
<div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
    <h1 class="h2">{{$title}}</h1>
</div>

<form method="post" action="/student/create">
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
                <input type="text" class="form-control" id="nisInput" placeholder="Nis siswa" name="nis" value="{{old('nis')}}">
            </div>
            <div class="mb-3">
                <label for="nameInput" class="form-label">Nama</label>
                <input type="text" class="form-control" id="nameInput" placeholder="Nama siswa" name="name" value="{{old('name')}}">
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
                <label for="dobInput" class="form-label">Tanggal lahir</label>
                <input type="date" class="form-control" id="dobInput" placeholder="Tanggal lahir" name="dob" value="{{old('dob')}}">
            </div>
            <div class="mb-3">
                <label for="pobInput" class="form-label">Tempat Lahir</label>
                <input type ="text"class="form-control" id="pobInput" placeholder="Tempat lahir" name="pob" value="{{old('pob')}}">
            </div>
            <div class="mb-3">
                <label for="genderInput" class="form-label">Jenis Kelamin</label>
                <div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender1Radio" value="1" @checked(old('gender') == 1)>
                        <label class="form-check-label" for="gender1Radio">Laki-laki</label>
                    </div>
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="gender" id="gender2Radio" value="2" @checked(old('gender') == 2)>
                        <label class="form-check-label" for="gender2Radio">Perempuan</label>
                    </div>
                </div>
            </div>
            <div>
                <button class="btn btn-primary" type="submit">Tambah</button>
            </div>
        </div>
    </div>
</form>

@endsection
