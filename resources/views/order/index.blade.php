@extends('layouts.main')

@section('container')
<div class="p-4 ordersmovie" style="min-height: 100vh">
    <div class="order row py-3 px-1 rounded">
        <div class="col-lg-8">
            <form action="/pay" method="POST" id="form-bayar">
                @csrf
                <h4>Movie</h4>
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
                <div class="row">
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="date" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-calendar-event"></i></span>
                            </label>
                            <select id="date" name="date" class="form-select" aria-label="Default select example">
                                <option selected>Tanggal</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="time" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-alarm"></i></span>
                            </label>
                            <select id="time" name="time" class="form-select" aria-label="Default select example">
                                <option selected>Jam</option>
                            </select>
                        </div>
                    </div>
                    <div class="col">
                        <div class="input-group mb-3">
                            <label for="theater" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-person-workspace"></i></span>
                            </label>
                            <select id="theater" name="theater" class="form-select" aria-label="Default select example">
                                <option selected>Theater</option>
                            </select>
                        </div>
                    </div>
                </div>
                <div id="schedules" class="row d-flex align-items-center">
                    <div class="col-lg-3 mt-2 col-6">
                        <div class="row">
                            <div class="col-2">
                                <span class="rounded"><i class="bi bi-cash-coin"></i></span>
                            </div>
                            <div id="price" class="col">
                                <p class="mb-0">00.00</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-9 mt-2 col-6">
                        <div class="row">
                            <div class="col-1 pe-0">
                                <span class="rounded"><i class="bi bi-grid"></i></span>
                            </div>
                            <div id="seat" class="col px-0">
                            </div>
                        </div>
                    </div>
                </div>
                <input id="penayangan_id" name="penayangan_id" type="hidden" value="" required>
                <input id="tiket_price" name="tiket_price" type="hidden" value="" required>
                <input id="addon_price" name="addon_price" type="hidden" value="" required>
                <input type="hidden" name="total_price" value="" required>
                <input type="hidden" name="id_movie" value="" required>
                <hr>
                <div id="jumlah" class="row">
                    <div class="col-6 col-lg-3 mb-3 tiket">
                        <p class="fs-5">Jumlah tiket</p>
                        <span id="kurang" class="rounded">
                            <i class="bi bi-dash-circle"></i>
                        </span>
                        <input type="text" id="jml_tiket" autocomplete="off" name="jml_tiket" style="width: 50px; text-align: center;" class="mx-3" value="0" readonly="readonly">
                        <span id="tambah" class="rounded">
                            <i class="bi bi-plus-circle"></i>
                        </span>
                    </div>
                    <div class="col-lg-9 col-12">
                        <div class="show-seat">
                            <div class="row">
                                <div class="col-12 col-lg-3 mt-2">
                                    @php
                                    $ABC = ['A', 'B', 'C', 'D', 'E', 'F'];
                                    @endphp
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=1; $j <=4; $j++) <span id="{{$ABC[$i]}}{{$j}}">{{$ABC[$i]}}{{$j}}</span>
                                        @endfor
                                        @endfor
                                </div>
                                <div class="col-12 col-lg-5 mt-2">
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=5; $j < 12; $j++) <span id="{{$ABC[$i]}}{{$j}}">{{$ABC[$i]}}{{$j}}</span>
                                        @endfor
                                        @endfor
                                </div>
                                <div class="col-12 col-lg-3 mt-2">
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=12; $j < 16; $j++) <span id="{{$ABC[$i]}}{{$j}}">{{$ABC[$i]}}{{$j}}</span>
                                        @endfor
                                        @endfor
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <div class="row">
                    <div class="col-4 pe-0">
                        <h4>Makanan & Minuman</h4>
                    </div>
                    <div class="col px-0 d-flex align-items-center mb-1">
                        <div class="col-6 col-lg-12 tiket">
                            <span id="kurangb" class="rounded">
                                <i class="bi bi-dash-circle"></i>
                            </span>
                            <input type="text" id="banyak_addon" autocomplete="off" name="banyak_addon" style="width: 50px; text-align: center;" class="mx-3" value="0" readonly="readonly" hidden>
                            <span id="tambahb" class="rounded">
                                <i class="bi bi-plus-circle"></i>
                            </span>
                        </div>
                    </div>
                </div>
                <div class="row" id="addonb">
                    <div id="addonbs" class="col-lg-10 col-12">
                        <div class="input-group mb-3">
                            <label for="addon" class="input-group-prepend">
                                <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-basket2"></i></span>
                            </label>
                            <select id="baddon" autocomplete="off" name="addon[]" class="form-select" aria-label="Default select example">
                                <option adnp="00.00" selected>-</option>
                                @foreach ($viewData["addon"] as $addon)
                                <option adnp="{{ $addon->getPrice() }}">{{ $addon->getName() }}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div id="1addonbs" class="col mt-2">
                        <div class="row">
                            <div class="col-2">
                                <span class="rounded"><i class="bi bi-cash-coin"></i></span>
                            </div>
                            <div id="pricea" class="col">
                                <p>00.00</p>
                            </div>
                        </div>
                    </div>
                    <div id="2addonbs" class="col-6 col-lg-12 mb-3 tiket">
                        <span id="kuranga" class="rounded">
                            <i class="bi bi-dash-circle"></i>
                        </span>
                        <input type="text" id="jml_addon" autocomplete="off" name="jml_addon[]" style="width: 50px; text-align: center;" class="mx-3" value="0" readonly="readonly">
                        <span id="tambaha" class="rounded">
                            <i class="bi bi-plus-circle"></i>
                        </span>
                    </div>
                </div>
                <button id="submitform" class="btn btn-dark invisible" type="submit">submit</button>
            </form>
        </div>
        <div class="col-lg-4">
            <div class="total">
                <h4>Tambah Tiket</h4>
                <div class="row">
                    <div class="col-9">
                        <div class="form-check">
                            <input class="form-check-input invisible" type="checkbox" name="tiket-movie" value="" id="tiket-movie" checked>
                            <label class="form-check-label" style="font-size: 0.9rem" for="tiket-movie">
                                <span class="label-tiket">Title</span> | <span class="jml-tiket">0</span>
                            </label>
                        </div>
                    </div>
                    <div class="col price-t">
                        <p>00.00</p>
                    </div>
                </div>
                <div class="row">
                    <div class="col-9" id="addonbyr">
                        <div class="form-check">
                            <input class="form-check-input invisible" type="checkbox" name="addon" value="" id="addon" checked>
                            <label class="form-check-label" style="font-size: 0.9rem" for="addon">
                                <span class="label-addon">Addon</span> | <span class="jml-addon">0</span>
                            </label>
                        </div>
                    </div>
                    <div class="col-3 price-a">
                        <p>00.00</p>
                    </div>
                </div>
                <hr class="my-1">
                <div class="row">
                    <p style="color: rgb(228, 220, 220)">Pajak dan Biaya Tambahan</p>
                    <div class="col-9">
                        <p>PPN 11%</p>
                    </div>
                    <div class="col">
                        <p class="ppn">00.00</p>
                    </div>
                </div>
                <hr style="margin: 0">
                <div class="row mt-2">
                    <div class="col-9">
                        <p>Total</p>
                    </div>
                    <div class="col">
                        <p class="price-total">00.00</p>
                    </div>
                </div>
            </div>
            <div class="col-12" style="display: grid">
                <button id="btn-bayar" type="button" class="btn btn-primary w-100 rounded mx-auto">Lanjutkan</button>
            </div>
            <div class="my-5"></div>
            <div data-v-cbcc5384="" style="" class="col-12">
                <p data-v-cbcc5384="">Transaksi makin mudah dengan metode pembayaran terlengkap!</p>
                <div data-v-cbcc5384="" class="summary-cart metode mt-3">
                    <div data-v-cbcc5384="" class="d-flex mb-3">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/bca.svg" alt="bca" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/mandiri.svg" alt="mandiri" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/bri.svg" alt="bri" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/bni.svg" alt="bni" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/qris.svg" alt="qris" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/gopay.svg" alt="gopay" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/ovo.svg" alt="ovo" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/linkaja.svg" alt="linkaja" class="lazyload m-auto" width="36" height="16">
                    </div>
                    <div data-v-cbcc5384="" class="d-flex">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/dana.svg" alt="dana" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/shopeepay.svg" alt="shopeepay" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/indomaret.svg" alt="indomaret" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/alfamart.svg" alt="alfamart" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/visa.svg" alt="visa" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/master-card.svg" alt="master-card" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/jcb.svg" alt="jcb" class="lazyload m-auto" width="36" height="16">
                        <img data-v-cbcc5384="" src="https://niagaspace.sgp1.digitaloceanspaces.com/www/assets/images/2022/orderflow/icons/paypal.svg" alt="paypal" class="lazyload m-auto" width="36" height="16">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    function numberWithCommas(x) {
        var parts = x.toString().split(".");
        parts[0] = parts[0].replace(/\B(?=(\d{3})+(?!\d))/g, ".");
        return parts.join(",");
    }

    function addonprice(id) {
        var option = $(`#addonbs${id}`).find('option:selected');
        var adnprc = option.attr("adnp");
        var text = option.text();
        var prices = $(`.price-a`);
        var price = $(`#price p`);
        var jml_tiket = $('#jml_tiket');
        var value = parseInt(jml_tiket.val())
        var pricea = $(`#pricea${id} p`);
        var jml_addon = $(`#jml_addon${id}`);
        var valuea = parseInt(jml_addon.val())
        var textAddon = $(`#addonbs${id}`).find('option:selected').text();
        $(`.label-addon${id}`).text(textAddon);

        var textPrice = price.text().split('.').join('');
        var textPricea = pricea.text().split('.').join('');
        var textPrices = prices.text().split('.').join('');
        prices.text(numberWithCommas((parseFloat(textPrices) - (parseFloat(textPricea) * valuea))))
        var priceTotal = (parseFloat(textPrices) - (parseFloat(textPricea) * valuea)) + (parseFloat(textPrice) * value);

        var ppn = (priceTotal / 100) * 11;
        $('.ppn').text(numberWithCommas(ppn))

        var totalBayar = priceTotal + ppn;
        $('.price-total').text(numberWithCommas(totalBayar))
        $('input[name=total_price]').val(totalBayar)
        $('input[name=addon_price]').val((parseFloat(textPrices) - (parseFloat(textPricea) * valuea)))
        $('input[name=tiket_price]').val((parseFloat(textPrice) * value))

        jml_addon.val(0);
        $(`.jml-addon${id}`).text(0)
        switch (text) {
            case textAddon:
                pricea.text(numberWithCommas(adnprc))
                $('input[name=addon_price]').val(adnprc);
                break;
            default:
                pricea.text("0.000");
                $('input[name=addon_price]').val("0.000");
        }
    }

    function tambahadn(id) {
        var jml_addon = $(`#jml_addon${id}`);
        var price = $(`#price p`);
        var prices = $(`.price-a`);
        var jml_tiket = $('#jml_tiket');
        var value = parseInt(jml_tiket.val())
        var pricea = $(`#pricea${id} p`);
        var valuea = parseInt(jml_addon.val())
        var addon = $(`#addonbs${id}`).find('option:selected').text()
        valuea++
        var textPrice = price.text().split('.').join('');
        var textPricea = pricea.text().split('.').join('');
        var textPrices = prices.text().split('.').join('');
        var total = (parseFloat(textPrices)) + (parseFloat(textPricea));
        var priceTotal = (parseFloat(textPrice) * value) + total;
        prices.text(numberWithCommas(total))

        var ppn = (priceTotal / 100) * 11;
        $('.ppn').text(numberWithCommas(ppn))

        var totalBayar = priceTotal + ppn;
        $('.price-total').text(numberWithCommas(totalBayar))
        $('input[name=total_price]').val(totalBayar)
        $('input[name=addon_price]').val(total)
        $('input[name=tiket_price]').val((parseFloat(textPrice) * value))

        jml_addon.val(valuea)
        $(`.jml-addon${id}`).text(valuea)
    }

    function kurangadn(id) {
        var jml_tiket = $('#jml_tiket');
        var price = $(`#price p`);
        var prices = $(`.price-a`);
        var value = parseInt(jml_tiket.val())
        var pricea = $(`#pricea${id} p`);
        var jml_addon = $(`#jml_addon${id}`);
        var valuea = parseInt(jml_addon.val())
        if (valuea > 0) {
            valuea--
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var textPrices = prices.text().split('.').join('');
            prices.text(numberWithCommas((parseFloat(textPrices) - (parseFloat(textPricea)))))
            var priceTotal = (parseFloat(textPrices) - (parseFloat(textPricea))) + (parseFloat(textPrice) * value);
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))
            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val((parseFloat(textPrices) - (parseFloat(textPricea))))
            $('input[name=tiket_price]').val((parseFloat(textPrice) * value))
            jml_addon.val(valuea)
            $(`.jml-addon${id}`).text(valuea)
        }
    }

    $(document).ready(function() {
        $(document).on("click", ".opt-movie", function() {
            var price = $("#price p");
            var textMovie = $(this).find('span').text();
            $('#movie').val($(this).find('span').text())
            $(".label-tiket").text(textMovie);
            var movie = $(this).attr('id')
            $('input[name=id_movie]').val(movie)
            $('input[name=tiket_price]').val("00.00");
            price.text("00.00")
            $('#theater').val("Theater");
            $('#time').val("Time");
            $('#date').val("Date");
            $.ajax({
                type: "POST",
                url: "{{ route('order.dates') }}",
                data: {
                    movie_id: movie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    console.log(data);
                    $('#date').empty();
                    $('#date').append("<option>Date</option>")
                    $.each(data, function(index, value) {
                        $('#date').append("<option id=" + value + " value=" + value + ">" + value + "</option>");
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            $('.dropdown').addClass("invisible");
            var jml_tiket = $('#jml_tiket');
            jml_tiket.val(0)
            $(".jml-tiket").text(0)
            var price = $("#price p");
            price.text("00.00");
            var pricea = $(`.price-a`);
            var time = $("#time").find('option:selected').text()
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPricea));
            $(".price-t").text("00.00")
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))
            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(parseFloat(textPricea))
            $('input[name=tiket_price]').val((parseFloat(textPrice)))
        });

        $('#date').change(function() {
            var price = $("#price p");
            var option = $(this).find('option:selected');
            var value = option.val();
            var id = $('input[name=id_movie]').val();
            $('input[name=tiket_price]').val("00.00");
            price.text("00.00")
            $('#theater').val("Theater");
            $('#time').val("Time");
            $.ajax({
                type: "POST",
                url: "{{ route('order.times') }}",
                data: {
                    date: value,
                    movie_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $('#time').empty();
                    $('#time').append("<option>Time</option>")
                    $.each(data, function(index, value) {
                        $('#time').append("<option id=" + value + " value=" + value + ">" + value + "</option>");
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            $('.dropdown').addClass("invisible");
            var jml_tiket = $('#jml_tiket');
            jml_tiket.val(0)
            $(".jml-tiket").text(0)
            var price = $("#price p");
            price.text("00.00");
            var pricea = $(`.price-a`);
            var time = $("#time").find('option:selected').text()
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPricea));
            $(".price-t").text("00.00")
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))
            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(parseFloat(textPricea))
            $('input[name=tiket_price]').val((parseFloat(textPrice)))
        });

        $('#time').change(function() {
            var price = $("#price p");
            var option = $(this).find('option:selected');
            var value = option.val();
            var date = $('select[name=date]').val();
            var id = $('input[name=id_movie]').val();
            $('input[name=tiket_price]').val("00.00");
            price.text("00.00")
            $('#theater').val("Theater");
            $.ajax({
                type: "POST",
                url: "{{ route('order.theaters') }}",
                data: {
                    time: value,
                    date: date,
                    movie_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $('#theater').empty();
                    $('#theater').append("<option>Theater</option>")
                    $.each(data, function(index, value) {
                        $('#theater').append("<option id=" + value + " value=" + value + ">" + value + "</option>");
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            $('.dropdown').addClass("invisible");
            var jml_tiket = $('#jml_tiket');
            jml_tiket.val(0)
            $(".jml-tiket").text(0)
            var price = $("#price p");
            price.text("00.00");
            var pricea = $(`.price-a`);
            var time = $("#time").find('option:selected').text()
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPricea));
            $(".price-t").text("00.00")
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))
            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(parseFloat(textPricea))
            $('input[name=tiket_price]').val((parseFloat(textPrice)))
        });

        $('#theater').change(function() {
            var option = $(this).find('option:selected');
            var theater_id = option.attr("id");
            var price = $("#price p");
            var time = $('select[name=time]').val();
            var date = $('select[name=date]').val();
            var id = $('input[name=id_movie]').val();
            $.ajax({
                type: 'POST',
                url: "{{route('order.prices')}}",
                data: {
                    theater: theater_id,
                    time: time,
                    date: date,
                    movie_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $.each(data, function(index, value) {
                        price.text(numberWithCommas(data))
                        $('input[name=tiket_price]').val(data);
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
            $.ajax({
                type: 'POST',
                url: "{{route('order.ids')}}",
                data: {
                    theater: theater_id,
                    time: time,
                    date: date,
                    movie_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $.each(data, function(index, value) {
                        $('input[name=penayangan_id]').val(data);
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
            var penayangan_id = $('input[name=penayangan_id]').val();
            $.ajax({
                type: 'POST',
                url: "{{route('order.seats')}}",
                data: {
                    penayangan_id: penayangan_id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $.each(data, function(index, value) {
                        $('#' + value).addClass("invisible");
                        console.log('#' + value);
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
            var jml_tiket = $('#jml_tiket');
            jml_tiket.val(0)
            $(".jml-tiket").text(0)
            var price = $("#price p");
            price.text("00.00");
            var pricea = $(`.price-a`);
            var time = $("#time").find('option:selected').text()
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPricea));
            $(".price-t").text("00.00")
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))
            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(parseFloat(textPricea))
            $('input[name=tiket_price]').val((parseFloat(textPrice)))
        });

        $("#movie").bind("keypress click", function() {
            var value = $(this).val().toLowerCase();
            $('#list-movie li').filter(function() {
                $(this).toggle($(this).find('span').text().toLowerCase().indexOf(value) > -1)
            })
            $('.dropdown').removeClass("invisible");
        });

        $('#baddon').change(function() {
            var option = $(this).find('option:selected');
            var adnprc = option.attr("adnp");
            var text = option.text();
            var prices = $(`.price-a`);
            var price = $("#price p");
            var jml_tiket = $('#jml_tiket');
            var value = parseInt(jml_tiket.val())
            var pricea = $("#pricea p");
            var jml_addon = $('#jml_addon');
            var valuea = parseInt(jml_addon.val())
            var textAddon = $(this).find('option:selected').text();
            $(".label-addon").text(textAddon);

            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var textPrices = prices.text().split('.').join('');
            prices.text(numberWithCommas((parseFloat(textPrices) - (parseFloat(textPricea) * valuea))))
            var priceTotal = (parseFloat(textPrices) - (parseFloat(textPricea) * valuea)) + (parseFloat(textPrice) * value);

            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))

            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val((parseFloat(textPrices) - (parseFloat(textPricea) * valuea)))
            $('input[name=tiket_price]').val((parseFloat(textPrice) * value))

            jml_addon.val(0);
            $(`.jml-addon`).text(0)
            switch (text) {
                case textAddon:
                    pricea.text(numberWithCommas(adnprc))
                    $('input[name=addon_price]').val(adnprc);
                    break;
                default:
                    pricea.text("0.000");
                    $('input[name=addon_price]').val("0.000");
            }
        });

        $("#kurang").on('click', function() {
            var jml_tiket = $('#jml_tiket');
            var classrm = ".id-ch" + jml_tiket.val();
            var seat = $("#seat");
            var price = $("#price p");
            var value = parseInt(jml_tiket.val())
            var pricea = $(`.price-a`);
            if (value > 0) {
                value--
                jml_tiket.val(value)
                $(".jml-tiket").text(value)
                seat.children('input').last().remove()

                var textPrice = price.text().split('.').join('');
                var textPricea = pricea.text().split('.').join('');
                var priceTotal = (parseFloat(textPrice) * value) + (parseFloat(textPricea));

                $(".price-t").text(numberWithCommas(parseFloat(textPrice) * value))
                var ppn = (priceTotal / 100) * 11;
                $('.ppn').text(numberWithCommas(ppn))

                var totalBayar = priceTotal + ppn;
                $('.price-total').text(numberWithCommas(totalBayar))
                $('input[name=total_price]').val(totalBayar)
                $('input[name=addon_price]').val(parseFloat(textPricea))
                $('input[name=tiket_price]').val((parseFloat(textPrice) * value))
            }
        });


        $("#tambah").on('click', function() {
            var jml_tiket = $('#jml_tiket');
            var price = $("#price p");
            var value = parseInt(jml_tiket.val())
            var pricea = $(`.price-a`);
            var time = $("#time").find('option:selected').text()

            value++
            jml_tiket.val(value)
            $(".jml-tiket").text(value)

            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPrice) * value) + (parseFloat(textPricea));
            $(".price-t").text(numberWithCommas(parseFloat(textPrice) * value))

            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))

            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(parseFloat(textPricea))
            $('input[name=tiket_price]').val((parseFloat(textPrice) * value))

        });

        $("#kuranga").on('click', function() {
            var jml_tiket = $('#jml_tiket');
            var price = $("#price p");
            var prices = $(`.price-a`);
            var value = parseInt(jml_tiket.val())
            var pricea = $("#pricea p");
            var jml_addon = $('#jml_addon');
            var valuea = parseInt(jml_addon.val())
            if (valuea > 0) {
                valuea--
                var textPrice = price.text().split('.').join('');
                var textPricea = pricea.text().split('.').join('');
                var textPrices = prices.text().split('.').join('');
                prices.text(numberWithCommas((parseFloat(textPrices) - (parseFloat(textPricea)))))
                console.log((parseFloat(textPricea) * valuea));
                var priceTotal = (parseFloat(textPrices) - (parseFloat(textPricea))) + (parseFloat(textPrice) * value);
                var ppn = (priceTotal / 100) * 11;
                $('.ppn').text(numberWithCommas(ppn))
                var totalBayar = priceTotal + ppn;
                $('.price-total').text(numberWithCommas(totalBayar))
                $('input[name=total_price]').val(totalBayar)
                $('input[name=addon_price]').val((parseFloat(textPrices) - (parseFloat(textPricea))))
                $('input[name=tiket_price]').val((parseFloat(textPrice) * value))
                jml_addon.val(valuea)
                $(".jml-addon").text(valuea)
            }
        });


        $("#tambaha").on('click', function() {
            var jml_addon = $('#jml_addon');
            var price = $("#price p");
            var prices = $(`.price-a`);
            var jml_tiket = $('#jml_tiket');
            var value = parseInt(jml_tiket.val())
            var pricea = $("#pricea p");
            var valuea = parseInt(jml_addon.val())
            var addon = $("#addon").find('option:selected').text()

            valuea++
            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var textPrices = prices.text().split('.').join('');
            var total = (parseFloat(textPrices)) + (parseFloat(textPricea));
            var priceTotal = (parseFloat(textPrice) * value) + total;
            prices.text(numberWithCommas(total))

            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))

            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val(total)
            $('input[name=tiket_price]').val((parseFloat(textPrice) * value))
            jml_addon.val(valuea)
            $(".jml-addon").text(valuea)
        });

        $("#kurangb").on('click', function() {
            var banyak_addon = $('#banyak_addon');
            var valueb = parseInt(banyak_addon.val())
            if (valueb > 0) {
                var jml_tiket = $('#jml_tiket');
                var price = $("#price p");
                var prices = $(`.price-a`);
                var value = parseInt(jml_tiket.val())
                var pricea = $(`#pricea${valueb} p`);
                var jml_addon = $(`#jml_addon${valueb}`);
                var valuea = parseInt(jml_addon.val())
                if (valuea > 0) {
                    var textPrice = price.text().split('.').join('');
                    var textPricea = pricea.text().split('.').join('');
                    var textPrices = prices.text().split('.').join('');
                    prices.text(numberWithCommas((parseFloat(textPrices) - (parseFloat(textPricea) * valuea))))
                    var priceTotal = (parseFloat(textPrices) - (parseFloat(textPricea)) * valuea) + (parseFloat(textPrice) * value);
                    var ppn = (priceTotal / 100) * 11;
                    $('.ppn').text(numberWithCommas(ppn))
                    var totalBayar = priceTotal + ppn;
                    $('.price-total').text(numberWithCommas(totalBayar))
                    $('input[name=total_price]').val(totalBayar)
                    $('input[name=addon_price]').val((parseFloat(textPrices) - (parseFloat(textPricea) * valuea)))
                    $('input[name=tiket_price]').val((parseFloat(textPrice) * value))
                    jml_addon.val(valuea)
                    $(`.jml-addon${valueb}`).text(valuea)
                    valuea--
                }
                $(`#addonbss${valueb}`).remove();
                $(`#1addonbs${valueb}`).remove();
                $(`#2addonbs${valueb}`).remove();
                $(`#1addonbyr${valueb}`).remove();
                $(`#2addonbyr${valueb}`).remove();
                valueb--
                banyak_addon.val(valueb)
                $(".banyak_addon").text(valueb)
            }
        });

        $("#tambahb").on('click', function() {
            var banyak_addon = $('#banyak_addon');
            var valueb = parseInt(banyak_addon.val());
            valueb++;
            banyak_addon.val(valueb);
            $(".banyak_addon").text(valueb);
            $('#addonb').append(`<div id="addonbss${valueb}" class="col-lg-10 col-12"><div class="input-group mb-3"><label for="addon${valueb}" class="input-group-prepend"><span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-basket2"></i></span></label><select id="addonbs${valueb}" onchange="addonprice(${valueb})" autocomplete="off" name="addon[]" class="form-select" aria-label="Default select example">    <option adnp="00.00" selected>-</option>
                                @foreach ($viewData["addon"] as $addon)
                                <option adnp="{{ $addon->getPrice() }}">{{ $addon->getName() }}</option>
                                @endforeach</select></div></div><div id="1addonbs${valueb}" class="col mt-2"><div class="row"> <div class="col-2"> <span class="rounded"><i class="bi bi-cash-coin"></i></span> </div> <div id="pricea${valueb}" class="col"> <p>00.00</p> </div></div></div><div id="2addonbs${valueb}" class="col-6 col-lg-12 mb-3 tiket"><span id="kuranga${valueb}" onClick="kurangadn(${valueb})" class="rounded"> <i class="bi bi-dash-circle"></i> </span><input type="text" id="jml_addon${valueb}" autocomplete="off" name="jml_addon[]" style="width: 50px; text-align: center;" class="mx-3" value="0" readonly="readonly"> <span id="tambaha${valueb}"  onClick="tambahadn(${valueb})" class="rounded"><i class="bi bi-plus-circle"></i> </span></div></div>`);
            $('#addonbyr').append(`<div class="col-9" id="1addonbyr${valueb}">
                        <div class="form-check">
                            <input class="form-check-input invisible" type="checkbox" name="addon" value="" id="addon${valueb}" checked>
                            <label class="form-check-label" style="font-size: 0.9rem" for="addon${valueb}">
                                <span class="label-addon${valueb}">Addon</span> | <span class="jml-addon${valueb}">0</span>
                            </label>
                        </div>
                    </div>`);
        });

        $(".show-seat span").on('click', function() {
            var seat = $("#seat");
            var jml_tiket = $('#jml_tiket');
            var value = $('#jml_tiket').val();
            var lengtseat = seat.children('input').length;
            if (lengtseat < value > 0) {
                seat.append("<input type='text' class='text-white' name='seat[]' style='width: 30px; background-color:transparent; border: none;' value='" + $(this).text() + "' readonly='readonly'>")
            } else if (0 < value && value == lengtseat) {
                seat.children('input').last().val($(this).text());
                // $(this).addClass("invisible");
            }
        })

        $('#btn-bayar').on('click', function() {
            $("#submitform").click()
        })
    });
</script>
@endsection