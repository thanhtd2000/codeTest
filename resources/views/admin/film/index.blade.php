@extends('admin.layouts.footer')
@extends('admin.layouts.master')
@extends('admin.layouts.header')
@section('content')
    <div class="d-flex align-items-center justify-content-between"> <button type="button" class="btn btn-primary"><a
                class="text-danger" href="create">Thêm mới</a></button>
        <div class="row g-3 align-items-center">
            <form action="{{ route('film.search') }}" method="fim" class="d-flex">
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
                <th scope="col">Tiêu đề</th>
                <th scope="col">Loại phim</th>
                <th scope="col">Ảnh</th>
                <th scope="col">Đạo diễn</th>
                <th scope="col">Diễn viên</th>
                <th scope="col">Năm SX</th>
                <th scope="col">Thời gian tạo</th>
                <th scope="col">Chức năng</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($films as $key => $fim)
                <tr>
                    <th scope="row">{{ $key + 1 }}</th>
                    <td>{{ $fim->name }}</td>
                    <td>{{ $fim->type }}</td>
                    <td><img src="../../../{{ $fim->image }}" width="100" alt=""></td>
                    <td>{{ $fim->director }}</td>
                    <td>{{ $fim->actor }}</td>
                    <td>{{ $fim->year }}</td>
                    <td>{{ $fim->created_at }}</td>
                    <td class="whitespace-nowrap">

                        <button type="button" class="btn btn-success"><a href="edit/{{ $fim->id }}">Sửa</a></button>
                        <button type="button" class="btn btn-danger"><a onclick=" return confirm('Bạn có chắc chắn xoá?')"
                                href="delete/{{ $fim->id }}">Xoá</a></button>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{ $films->links() }}
@endsection
