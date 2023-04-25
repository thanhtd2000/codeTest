@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')

@section('content')
    <?php
    use App\Models\Order;
    ?>
    <section class="main-container">
        <h3> Lịch sử đơn hàng</h3>
        @if (session('message'))
            <h4 class="aler alert-danger pt-3 pb-3">
                <strong class="text-danger">{{ session('message') }}</strong>
            </h4>
        @endif

        <table class="table text-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Giá</th>
                    <th scope="col">Người đặt</th>
                    <th scope="col">Trạng thái</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($orders as $key => $order)
                    <tr>
                        <th scope="row">{{ $key + 1 }}</th>
                        <td>{{ $order->price }}</td>
                        <td>{{ $order->user->name }}</td>
                        <td>Đã thanh toán</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h3> Thông tin vé</h3>
        <table class="table text-white">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Vị trí</th>
                    <th scope="col">Thời gian</th>
                    <th scope="col">Giá vé</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($tickets as $key => $ticket)
                    @if ($ticket->Order->user_id == Auth::id())
                        <tr>
                            <th scope="row">{{ $key + 1 }}</th>
                            <td>{{ $ticket->seat_name }}</td>
                            <td>{{ $ticket->schedule->date }}</td>
                            <td>10000 VND</td>
                        </tr>
                    @endif
                @endforeach
                </tr>
            </tbody>
        </table>
    </section>
@endsection
