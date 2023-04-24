@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('room.post') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên phòng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="name" aria-describedby="emailHelp">
            @if ($errors->has('name'))
                <span class="text-danger fs-3">
                    {{ $errors->first('name') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số Hàng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="row" aria-describedby="emailHelp">
            @if ($errors->has('row'))
                <span class="text-danger fs-3">
                    {{ $errors->first('row') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Số ghế một hàng</label>
            <input type="text" class="form-control" id="exampleInputEmail1" name="seat_number"
                aria-describedby="emailHelp">
            @if ($errors->has('seat_number'))
                <span class="text-danger fs-3">
                    {{ $errors->first('seat_number') }}
                </span>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
