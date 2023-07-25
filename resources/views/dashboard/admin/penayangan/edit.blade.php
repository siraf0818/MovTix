@extends('dashboard.layouts.main')
@section('container')
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3 ">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Edit Theater Showing</h5>
        </div>
        <div class="card-body">
            @if($errors->any())
            <ul class="alert alert-danger list-unstyled">
                @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
            </ul>
            @endif

            <form method="POST" action="{{ route('dashboard.admin.penayangan.update', ['id'=> $viewData['penayangan']->getId()]) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <input name="id" value="{{ $viewData['penayangan']->getId() }}" type="text" class="form-control mb-3" hidden>
                <input id="id" value="{{ $viewData['penayangan']->getId() }}" type="text" class="form-control mb-3" disabled>
                <input name="id_movie" value="{{ $viewData['penayangan']->getIdMovie() }}" type="text" class="form-control mb-3" hidden>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="theater" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                            </label>
                            <select id="theater" name="theater" class="form-select" aria-label="Default select example">
                                <option selected value="{{ $viewData['penayangan']->getTheater() }}">{{ $viewData['penayangan']->getTheater() }}</option>
                                <option value="T1">Theater 1</option>
                                <option value="T2">Theater 2</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="row">
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label for="date" class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                                    </label>
                                    <input class="form-control" value="{{ $viewData['penayangan']->getDate() }}" id="date" name="date" placeholder="MM/DD/YYY" type="date" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label for="time" class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                                    </label>
                                    <input class="form-control" value="{{ $viewData['penayangan']->getTime() }}" id="time" name="time" placeholder="Time" type="time" />
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3 position-relative" style="z-index: 100">
                            <label for="movie" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-film"></i></span>
                            </label>
                            <input type="search" id="movie" value="{{ $viewData['penayangan']->getMovie() }}" class="form-control" hint="off" autocomplete="off" name="movie" placeholder="Cari film..." required />
                            <div class="dropdown mt-2 invisible w-100">
                                <ul id="list-movie" class="p-2 w-100 bg-white rounded text-black list-unstyled position-absolute">
                                    @foreach ($posts as $p)
                                    <li id="{{$p["id"]}}" class='opt-movie'><img src="{{$p["bannerUrl"]}}" alt='' width='30px' class='mr-3'><span class='my-auto'>{{$p["title"]}}</span></li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="price" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                            </label>
                            <input class="form-control" value="{{ $viewData['penayangan']->getPrice() }}" id="price" name="price" placeholder="Price" type="number" />
                        </div>
                    </div>
                </div>
                <div class="d-flex justify-content-start my-2">
                    <button class="btn badge-save px-4" style="color: #ffffff; background: #52527a;">Save </button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $("#movie").bind("keypress click", function() {
            var value = $(this).val().toLowerCase();
            $('#list-movie li').filter(function() {
                $(this).toggle($(this).find('span').text().toLowerCase().indexOf(value) > -1)
            })
            $('.dropdown').removeClass("invisible");
        });
        $('#theater').change(function() {
            var theater = $('#theater').val();
            var date = $('#date').val();
            var time = $('#time').val();
            $('input[name=id]').val(theater + date + time);
            $('#id').val(theater + date + time);
        });
        $('#date').change(function() {
            var theater = $('#theater').val();
            var date = $('#date').val();
            var time = $('#time').val();
            $('input[name=id]').val(theater + date + time)
            $('#id').val(theater + date + time);
        });
        $('#time').change(function() {
            var theater = $('#theater').val();
            var date = $('#date').val();
            var time = $('#time').val();
            $('input[name=id]').val(theater + date + time)
            $('#id').val(theater + date + time);
        });
    });

    $(document).on("click", ".opt-movie", function() {
        var textMovie = $(this).find('span').text();
        $('#movie').val($(this).find('span').text())
        var movie = $(this).attr('id')
        console.log(movie)
        $('input[name=id_movie]').val(movie)
        $('.dropdown').addClass("invisible");
    });
</script>
@endsection