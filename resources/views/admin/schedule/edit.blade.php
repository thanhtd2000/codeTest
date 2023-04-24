@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <form class="col-md-8" action="{{ route('schedule.update') }}" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $schedule->id }}">
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Thời gian chiếu</label>
            <input type="datetime-local" class="form-control" id="exampleInputEmail1" value="{{ $schedule->date }}"
                name="date" aria-describedby="emailHelp">
            @if ($errors->has('date'))
                <span class="text-danger fs-3">
                    {{ $errors->first('date') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên Phim</label>
            <select name="film_id" id="">
                @foreach ($films as $item)
                    @if ($item->id == $schedule->film_id)
                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('film_id'))
                <span class="text-danger fs-3">
                    {{ $errors->first('film_id') }}
                </span>
            @endif
        </div>
        <div class="mb-3">
            <label for="exampleInputEmail1" class="form-label">Tên phòng</label>
            <select name="room_id" id="">
                @foreach ($rooms as $item)
                    @if ($item->id == $schedule->room_id)
                        <option selected value="{{ $item->id }}">{{ $item->name }}</option>
                    @else
                        <option value="{{ $item->id }}">{{ $item->name }}</option>
                    @endif
                @endforeach
            </select>
            @if ($errors->has('room_id'))
                <span class="text-danger fs-3">
                    {{ $errors->first('room_id') }}
                </span>
            @endif
        </div>
        <br>
        <button type="submit" class="btn btn-primary">Thêm</button>
    </form>
@endsection
