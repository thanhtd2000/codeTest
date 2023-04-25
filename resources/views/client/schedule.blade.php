@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')

@section('content')
    <?php
    use Carbon\Carbon;
    use App\Models\Ticket;
    ?>
    <section class="main-container">
        <p class="text-danger"> 说明:Quý khác vẫn Check được vẫn đặt được!!! <br> Không check được là do khách khác
            đặt
            rồi ạ !!!</p>
        <form action="{{ route('order') }}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::id() }}">
            <input type="hidden" name="schedule_id" value="{{ $schedule->id }}">
            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        @for ($i = 1; $i <= $schedule->room->seat_number; $i++)
                            <th scope="col">{{ $i }}</th>
                        @endfor
                    </tr>
                </thead>
                <tbody>

                    @foreach ($elements as $item)
                        <tr>
                            <th>{{ $item }}</th>
                            @for ($i = 1; $i <= $schedule->room->seat_number; $i++)
                                <th scope="row">
                                    @if (
                                        $ticket->contains(function ($t) use ($item, $i, $schedule) {
                                            return $t->seat_name == $item . $i && $t->schedule_id == $schedule->id && $t->schedule->date == $schedule->date;
                                        }))
                                        <input disabled style="" type="checkbox" name="seat_name[]"
                                            value="{{ $item . $i }}">
                                    @else
                                        <input type="checkbox" name="seat_name[]" value="{{ $item . $i }}">
                                    @endif{{ $item . $i }}
                                </th>
                            @endfor
                        </tr>
                    @endforeach



                </tbody>
            </table>
            <button type="submit" class="btn btn-outline-primary">Đặt vé</button>
        </form>

    </section>
@endsection
