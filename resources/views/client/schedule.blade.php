@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')

@section('content')
    <?php
    use Carbon\Carbon;
    use App\Models\Ticket;
    ?>

    <section class="main-container">
        <div class="sidebar">
            <form action="#">
            </form>
        </div>
        <div class="movies-container">
            <div class="upcoming-img-box">
                <img src="assets/images/upcoming.webp" alt="">
                <p class="upcoming-title">Sắp ra mắt</p>
                <div class="buttons">
                    <a href="#" class="btn">Đặt ngay</a>
                    <a href="#" class="btn-alt btn">Xem Trailer</a>
                </div>
            </div>
            <div class="current-movies">
                <p class="text-danger"> 说明:Quý khác vẫn Check được vẫn đặt được!!! <br> Không check được là do khách khác
                    đặt
                    rồi ạ !!!</p>

                <section class="main-container">
                    <form action="{{ route('order') }}" method="POST">
                        @csrf
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
                                                        return $t->seat_name == $item . $i && $t->schedule_id == $schedule->id;
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
            </div>
        </div>

    </section>
    <!-- Modal -->

    <script>
        const myModal = document.getElementById('myModal')
        const myInput = document.getElementById('myInput')

        myModal.addEventListener('shown.bs.modal', () => {
            myInput.focus()
        })
    </script>
@endsection
