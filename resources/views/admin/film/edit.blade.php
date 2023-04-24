@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('film.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $film->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Phim</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" value="{{ $film->name }}"
                aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="text-danger fs-3">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Loại Phim</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="type" value="{{ $film->type }}"
                aria-describedby="emailHelp">
            @if ($errors->has('type'))
                <span class="text-danger fs-3">
                    {{ $errors->first('type') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Ảnh</label>
            <input type="file" class="form-control" id="exampleInputEmail1" name="image" value="{{ $film->image }}"
                aria-describedby="emailHelp">
            @if ($errors->has('image'))
                <span class="text-danger fs-3">
                    {{ $errors->first('image') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Đạo diễn</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $film->director }}" name="director"
                aria-describedby="emailHelp">
            @if ($errors->has('director'))
                <span class="text-danger fs-3">
                    {{ $errors->first('director') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Diễn viên</label>
            <input type="text" class="form-control" id="exampleInputEmail1" value="{{ $film->actor }}" name="actor"
                aria-describedby="emailHelp">
            @if ($errors->has('actor'))
                <span class="text-danger fs-3">
                    {{ $errors->first('actor') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Năm sản xuất</label>
            <input type="number" class="form-control" id="exampleInputEmail1" value="{{ $film->year }}" name="year"
                aria-describedby="emailHelp">
            @if ($errors->has('year'))
                <span class="text-danger fs-3">
                    {{ $errors->first('year') }}
                </span>
            @endif
        </div>
        <br>

        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
