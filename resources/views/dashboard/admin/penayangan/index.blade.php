@extends('dashboard.layouts.main')
@section('container')
<<<<<<< HEAD
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3 ">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Create Theater Showing</h5>
        </div>
        <div class="card-body">
            @if($errors->any())
            <ul class="alert alert-danger list-unstyled">
                @foreach($errors->all() as $error)
                <li>- {{ $error }}</li>
                @endforeach
            </ul>
            @endif
            <form method="POST" action="{{ route('dashboard.admin.penayangan.store') }}" enctype="multipart/form-data">
                @csrf
                <input name="id" value="" type="text" class="form-control mb-3" hidden>
                <input id="id" value="" type="text" class="form-control mb-3" disabled>
                <input name="id_movie" value="" type="text" class="form-control mb-3" hidden>
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="theater" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                            </label>
                            <select id="theater" name="theater" class="form-select" aria-label="Default select example">
                                <option selected>Pilih Theater</option>
                                @foreach ($viewData["theater"] as $theater)
                                <option value="{{ $theater->getId() }}">{{ $theater->getName() }}</option>
=======
<div class="card mb-4">
    <div class="card-header">
        Create Penayangan
    </div>
    <div class="card-body">
        @if($errors->any())
        <ul class="alert alert-danger list-unstyled">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        @endif
        <form method="POST" action="{{ route('dashboard.admin.penayangan.store') }}" enctype="multipart/form-data">
            @csrf
            <input name="id" value="" type="text" class="form-control mb-3" hidden>
            <input id="id" value="" type="text" class="form-control mb-3" disabled>
            <input name="id_movie" value="" type="text" class="form-control mb-3" hidden>
            <div class="row">
                <div class="col">
                    <div class="input-group mb-3">
                        <label for="theater" class="input-group-prepend">
                            <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                        </label>
                        <select id="theater" name="theater" class="form-select" aria-label="Default select example">
                            <option selected>Pilih Theater</option>
                            @foreach ($viewData["theater"] as $theater)
                            <option value="{{ $theater->getId() }}">{{ $theater->getName() }}</option>
                            @endforeach
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
                                <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="date" />
                            </div>
                        </div>
                        <div class="col">
                            <div class="input-group mb-3">
                                <label for="time" class="input-group-prepend">
                                    <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                                </label>
                                <input class="form-control" id="time" name="time" placeholder="Time" type="time" />
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
                        <input type="search" id="movie" class="form-control" hint="off" autocomplete="off" name="movie" placeholder="Cari film..." required />
                        <div class="dropdown mt-2 invisible w-100">
                            <ul id="list-movie" class="p-2 w-100 bg-white rounded text-black list-unstyled position-absolute">
                                @foreach ($posts as $p)
                                <li id="{{$p["id"]}}" class='opt-movie'><img src="{{$p["bannerUrl"]}}" alt='' width='30px' class='mr-3'><span class='my-auto'>{{$p["title"]}}</span></li>
>>>>>>> c087d85da0b364bdf061c116771995f6a7493a21
                                @endforeach
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
                                    <input class="form-control" id="date" name="date" placeholder="MM/DD/YYY" type="date" />
                                </div>
                            </div>
                            <div class="col">
                                <div class="input-group mb-3">
                                    <label for="time" class="input-group-prepend">
                                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                                    </label>
                                    <input class="form-control" id="time" name="time" placeholder="Time" type="time" />
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
                            <input type="search" id="movie" class="form-control" hint="off" autocomplete="off" name="movie" placeholder="Cari film..." required />
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
                            <input class="form-control" id="price" name="price" placeholder="Price" type="number" />
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
<div class="details row px-4 gap-3 position-relative">
    <div class="recentCustomer col p-3">
        <div class="cardHeader d-flex justify-content-between">
            <h5>Manage Penayangan</h5> 
            <div class="search" style="width: 200px; height: 40px; padding-bottom: 8px;">
                <label for="" style="height: 100%;">
                    <input style="height: 100%" id="searchval" type="text" placeholder="Search..">
                    <ion-icon style="height: 100%" name="search-outline"></ion-icon>
                </label>
            </div>
        </div>
        <div class="table-customer overflow-auto">
            <table class="table align-middle mb-0 bg-white">
                <thead class="bg-light">
                    <tr>
                        <th scope="col">ID</th>
                        <th scope="col">Theater</th>
                        <th scope="col">Date</th>
                        <th scope="col">Time</th>
                        <th scope="col">Movie</th>
                        <th scope="col">Price</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($viewData["penayangan"] as $penayangan)
                    <tr>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getId() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getTheater() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getDate() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getTime() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getMovie() }}</p>
                        </td>
                        <td>
                            <p class="fw-normal mb-1">{{ $penayangan->getPrice() }}</p>
                        </td>
                        <td>
                            <div class="row w-10">
                                <div class="col-lg-4">
                                    <!-- edit -->
                                    <a class="badge badge-edit text-white bg-primary rounded-pill d-inline" href="{{route('dashboard.admin.penayangan.edit', ['id'=> $penayangan->getId()])}}">
                                        edit
                                    </a>
                                </div>

                                <div class="col-lg-4">
                                    <!-- delete -->
                                    <form action="{{ route('dashboard.admin.penayangan.delete', $penayangan->getId())}}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <a type="submit" onclick="return confirm('Are you sure?')" class="badge btn badge-delete text-white bg-danger rounded-pill d-inline">
                                            delete
                                        </a>
                                    </form>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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