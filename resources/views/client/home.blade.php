@extends('client.layouts.footer')
@extends('client.layouts.master')
@extends('client.layouts.header')

@section('content')
    <?php
    use Carbon\Carbon; ?>
    <section class="main-container">
        <div class="sidebar">
            <form action="#">
                <div class="sidebar-groups">
                    <h3 class="sg-title">Categories</h3>
                    <input type="checkbox" id="adventure" name="adventure" value="adventure">
                    <label for="adventure">Adventure</label><br>
                    <input type="checkbox" id="action" name="action" value="action">
                    <label for="action">Action</label><br>
                    <input type="checkbox" id="animation" name="animation" value="animation">
                    <label for="animation">Animation</label><br>
                    <input type="checkbox" id="comedy" name="comedy" value="comedy">
                    <label for="comedy">Comedy</label><br>
                    <input type="checkbox" id="science" name="science" value="science">
                    <label for="science">Science Fiction</label><br>
                    <input type="checkbox" id="thriller" name="thriller" value="thriller">
                    <label for="thriller">Thriller</label><br>
                    <input type="checkbox" id="history" name="history" value="history">
                    <label for="history">History</label><br>
                    <input type="checkbox" id="documentary" name="documentary" value="documentary">
                    <label for="documentary">Documentary</label><br>
                    <input type="checkbox" id="fantasy" name="fantasy" value="fantasy">
                    <label for="fantasy">Fantasy</label><br>

                </div>
                <div class="sidebar-groups">
                    <h3 class="sg-title">Language</h3>
                    <input type="checkbox" id="english" name="english" value="english">
                    <label for="english">English</label><br>
                    <input type="checkbox" id="spanish" name="spanish" value="spanish">
                    <label for="spanish">Spanish</label><br>
                    <input type="checkbox" id="hindi" name="hindi" value="hindi">
                    <label for="hindi">Hindi</label><br>
                </div>
                <div class="sidebar-groups">
                    <h3 class="sg-title">Time</h3>
                    <input type="radio" id="morning" name="time" value="morning">
                    <label for="morning">Morning</label><br>
                    <input type="radio" id="night" name="time" value="night">
                    <label for="night">Night</label><br>
                </div>
                <div class="sidebar-groups">
                    <a href="#" class="btn-l btn">Apply Filters</a>
                </div>
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
                @foreach ($films as $kei => $item)
                    <div class="current-movie">
                        <div class="cm-img-box">
                            <img src="../{{ $item->image }}" alt="">
                        </div>
                        <h3 class="movie-title">{{ $item->name }}</h3>
                        <p class="screen-name">{{ $item->type }}</p>
                        <div class="booking">
                            <h2 class="price">Năm :{{ $item->year }}</h2>
                            <button type="button" class="btn btn-primary" data-bs-toggle="modal"
                                data-bs-target="#exampleModal{{ $kei + 1 }}">
                                Đặt vé
                            </button>
                        </div>
                        <div class="modal fade" id="exampleModal{{ $kei + 1 }}" tabindex="-1"
                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Lịch ngày hôm
                                            nay {{ date('d/m/y', time()) }}</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                            aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body text-dark">
                                        @foreach ($item->Schedule as $value)
                                            @if ($value->date >= Carbon::now())
                                                <a href="/buy-ticket/{{ $value->id }}"
                                                    class="m-2 border border-secondary rounded-pill p-1 bg-primary">{{ Carbon::parse($value->date)->format('H:i') }}</a>
                                            @endif
                                        @endforeach
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">Huỷ</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
                <div class="text-black"> {{ $films->links() }}</div>
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
