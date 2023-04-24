@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-danger" href="create">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('schedule.search') }}" method="post" class="d-flex">
                @csrf
                <div class="col-auto">
                    <input type="text" name="keywords" id="inputEmail6" class="form-control" placeholder="Nhập từ khoá">
                </div>
                <button type="button" class="btn btn-primary text-black ms-3">Tìm kiếm</button>
            </form>
        </div>
    </div>
    <div class="message text-center">
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong class="text-danger">{{ session('message') }}</strong>
            </h4>
        @endif
    </div>

    @csrf
    @method('DELETE')
    <table class="table">
        <thead>
            <tr>
                <th scope="col">STT</th>
                <th scope="col">Thời gian chiếu</th>
                <th scope="col">Tên Phim</th>
                <th scope="col">Tên Phòng</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($schedules as $key => $schedule)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $schedule->date }}</td>
                    <td>{{ $schedule->film->name }}</td>
                    <td>{{ $schedule->room->name }}</td>
                    <td>{{ $schedule->created_at }}</td>
                    <td class="whitespace-nowrap">
                        <button type="button" class="btn btn-success"><a href="edit/{{ $schedule->id }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="delete/{{ $schedule->id }}">Xoá</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $schedules->links() }}
@endsection
