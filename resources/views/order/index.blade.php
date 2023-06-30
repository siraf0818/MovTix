@extends('layouts.main')

@section('container')
<div class="p-4 ordersmovie" style="min-height: 100vh">
    <div class="order row py-3 px-1 rounded">
        <div class="col-lg-8">
            <form action="/pay" method="POST" id="form-bayar">
                @csrf
                <h4>Movie</h4>
                <div class="input-group mb-3">
                    <label for="cities" class="input-group-prepend">
                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-geo-alt"></i></span>
                    </label>
                    <select id="cities" name="city" class="form-select" aria-label="Default select example">
                        <option selected>Pilih Kota</option>
                        @foreach ($cities as $city)
                        <option value="{{$city['name']}}" id="{{$city['id']}}"> {{$city['name']}}</option>
                        @endforeach
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label for="type" class="input-group-prepend">
                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-columns-gap"></i></span>
                    </label>
                    <select id="type" name="type" class="form-select" aria-label="Default select example">
                        <option selected>Pilih Type</option>
                    </select>
                </div>
                <div class="input-group mb-3">
                    <label for="theater" class="input-group-prepend">
                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-person-workspace"></i></span>
                    </label>
                    <select id="theater" name="theater" class="form-select" aria-label="Default select example">
                        <option selected>Pilih Theaters</option>
                    </select>
                </div>
                <div class="input-group mb-3 position-relative" style="z-index: 100">
                    <label for="movie" class="input-group-prepend">
                        <span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-film"></i></span>
                    </label>
                    <input type="search" id="movie" class="form-control" hint="off" autocomplete="off" name="movie" placeholder="Cari film..." required />
                    <div class="dropdown mt-2 invisible w-100">
                        <ul id="list-movie" class="p-2 w-100 bg-white rounded text-black list-unstyled position-absolute">
                        </ul>
                    </div>
                </div>
                <div id="schedules" class="row">
                    <div id="jadwal" class="col-lg-3 mt-2 col-6 position-relative">
                        <div class="row">
                            <div class="col-2">
                                <span class="rounded"><i class="bi bi-calendar-event"></i></span>
                            </div>
                            <div class="col-10 position-absolute text-date" style="left: 29px">
                                <p>00-00</p>
                            </div>
                        </div>
                        <div class="dropdwn-sc invisible position-absolute top-0">
                            <ul id="list-date" class="position-absolute rounded">
                                <li class='list-item-sc'>00-00</li>
                            </ul>
                        </div>
                    </div>
                    <div id="time-sl" class="col-lg-3 mt-2 col-6 position-relative">
                        <div class="row">
                            <div class="col-2"><span class="rounded"><i class="bi bi-alarm"></i></span></div>
                            <div class="col-10">
                                <select id="time" style="padding: 2px 4px;" name="time" class="form-select" autocomplete="off" aria-label="Default select example">
                                    <option selected>12:30</option>
                                    <option>13:00</option>
                                    <option>15:40</option>
                                    <option>16:10</option>
                                    <option>16:40</option>
                                    <option>19:10</option>
                                    <option>20:20</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-2 col-6">
                        <div class="row">
                            <div class="col-2">
                                <span class="rounded"><i class="bi bi-grid"></i></span>
                            </div>
                            <div id="seat" class="col">
                                <input type='text' class='text-white seat-i' name='seat[]' style='width: 30px; background-color:transparent; border: none;' value='A1' readonly='readonly'>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3 mt-2 col-6">
                        <div class="row">
                            <div class="col-2">
                                <span class="rounded"><i class="bi bi-cash-coin"></i></span>
                            </div>
                            <div id="price" class="col">
                                <p>00.00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <input id="date" name="date" type="hidden" value="" required>
                <input id="price" name="price" type="hidden" value="" required>
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
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=1; $j <=4; $j++) <span>{{$ABC[$i]}}{{$j}}</span>
                                        @endfor
                                        @endfor
                                </div>
                                <div class="col-12 col-lg-5 mt-2">
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=5; $j < 12; $j++) <span>{{$ABC[$i]}}{{$j}}</span>
                                        @endfor
                                        @endfor
                                </div>
                                <div class="col-12 col-lg-3 mt-2">
                                    @for ($i = 0; $i < count($ABC); $i++) @for ($j=12; $j < 16; $j++) <span>{{$ABC[$i]}}{{$j}}</span>
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
                                <option selected>-</option>
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
    <!-- <div class="row cardindex pt-3">
        @foreach ($posts as $p)
        <div class="col col-sm-2 col-md-4 col-lg-3 mb-4 mt-4">
            <a href="/movie/{{$p['id']}}" class="text-decoration-none text-black">
                <div class="card mx-auto" style="height: 95%">
                    <img src="{{$p["bannerUrl"]}}" alt="">
                    <div class="card-body">
                        <h6 class="card-title text-center">{{$p["title"]}}</h6>
                    </div>
                </div>
            </a>
        </div>
        @endforeach
    </div> -->
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
                $('input[name=price]').val(adnprc);
                break;
            default:
                pricea.text("0.000");
                $('input[name=price]').val("0.000");
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

        if (addon == "Serbu 1 (Popcorn Salt Kidz + Softdrink-S)") {
            pricea.text("1.000")
            $('input[name=price]').val("1.000");
        }

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
        $('#cities').on('change', function() {
            var $option = $(this).find('option:selected');
            var $city_id = $option.attr("id");
            $.ajax({
                type: "POST",
                url: "{{ route('order.cities') }}",
                data: {
                    cityid: $city_id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    console.log(data);
                    $('#type').empty();
                    $('#type').append("<option>Type</option>")
                    $.each(data, function(index, value) {
                        $('#type').append("<option id=" + value + " value=" + value + ">" + value + "</option>");
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
        }).trigger('change');
        $('#type').change(function() {
            var option = $(this).find('option:selected');
            var value = option.val();
            var id = $('#cities').find('option:selected').attr('id');

            $.ajax({
                type: "POST",
                url: "{{ route('order.theaters') }}",
                data: {
                    type: value,
                    city_id: id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $('#theater').empty();
                    $('#theater').append("<option>Theater</option>")
                    $.each(data, function(index, value) {
                        var nama = value.name;
                        $('#theater').append("<option id=" + value.id + " >" + value.name + "</option>");
                        $("#" + value.id).attr('value', value.name);
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
        });
        $('#theater').change(function() {
            var option = $(this).find('option:selected');
            var theater_id = option.attr("id");

            $.ajax({
                type: 'POST',
                url: "{{route('order.schedules')}}",
                data: {
                    theater: theater_id,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    $('#list-movie').empty();
                    $.each(data.schedules, function(index, value) {
                        $('#list-movie').append("<li id=" + value.movie.id + " class='opt-movie'><img src=" + value.movie.bannerUrl + " alt='' width='30px' class='mr-3'><span class='my-auto'>" + value.movie.title + "</span></li>")
                    })
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            })
        });

        $("#movie").bind("keypress click", function() {
            var value = $(this).val().toLowerCase();
            $('#list-movie li').filter(function() {
                $(this).toggle($(this).find('span').text().toLowerCase().indexOf(value) > -1)
            })
            $('.dropdown').removeClass("invisible");
        });

        $("#jadwal span").on('click', function() {
            var txtdefault = $(".text-date p");
            var dropdown = $('.dropdwn-sc');
            var lifirst = $("#list-date li").first().text()

            if (dropdown.hasClass("invisible")) {
                txtdefault.text("")
            } else {
                txtdefault.text(lifirst)
            }
            $('.dropdwn-sc').toggleClass("invisible");

        })
        $("#time span").on('click', function() {
            $('.dropdwn-time').toggleClass("invisible");
        })

        $('#time').change(function() {
            var option = $(this).find('option:selected');
            var text = option.text();
            var price = $("#price p");
            var jml_tiket = $('#jml_tiket');
            var value = parseInt(jml_tiket.val())
            var pricea = $(`.price-a`);
            switch (text) {
                case "12:30":
                    price.text("1.000")
                    $('input[name=price]').val("1.000");
                    break;
                case "13:00":
                    price.text("2.000")
                    $('input[name=price]').val("2.000");
                    break;
                case "15:40":
                    price.text("3.000")
                    $('input[name=price]').val("3.000");
                    break;
                case "16:10":
                    price.text("4.000")
                    $('input[name=price]').val("4.000");
                    break;
                case "16:40":
                    price.text("5.000")
                    $('input[name=price]').val("5.000");
                    break;
                case "19:10":
                    price.text("6.000")
                    $('input[name=price]').val("6.000");
                    break;
                case "20:20":
                    price.text("6.000")
                    $('input[name=price]').val("7.000");
                    break;
                default:
                    price.text("8.000");
                    $('input[name=price]').val("8.000");
            }

            var textPrice = price.text().split('.').join('');
            var textPricea = pricea.text().split('.').join('');
            var priceTotal = (parseFloat(textPrice) * value) + (parseFloat(textPricea));

            $(".price-t").text(numberWithCommas(parseFloat(textPrice) * value))
            var ppn = (priceTotal / 100) * 11;
            $('.ppn').text(numberWithCommas(ppn))

            var totalBayar = priceTotal + ppn;
            $('.price-total').text(numberWithCommas(totalBayar))
            $('input[name=total_price]').val(totalBayar)
            $('input[name=addon_price]').val((parseFloat(textPricea)))
            $('input[name=tiket_price]').val((parseFloat(textPrice) * value))

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
                    $('input[name=price]').val(adnprc);
                    break;
                default:
                    pricea.text("0.000");
                    $('input[name=price]').val("0.000");
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
            var seat = $("#seat");
            var time = $("#time").find('option:selected').text()

            if (time == "12:30") {
                price.text("1.000")
                $('input[name=price]').val("1.000");
            }

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

            var lengtseat = seat.children('input').length;

            if (lengtseat < jml_tiket.val()) {
                seat.append("<input type='text' class='text-white' name='seat[]' style='width: 30px; background-color:transparent; border: none;' value='A" + jml_tiket.val() + "' readonly='readonly'>");
            }
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

            if (addon == "Serbu 1 (Popcorn Salt Kidz + Softdrink-S)") {
                price.text("1.000")
                $('input[name=price]').val("1.000");

            }
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
            $('#addonb').append(`<div id="addonbss${valueb}" class="col-lg-10 col-12"><div class="input-group mb-3"><label for="addon${valueb}" class="input-group-prepend"><span class="input-group-text rounded-0" id="basic-addon1"><i class="bi bi-basket2"></i></span></label><select id="addonbs${valueb}" onchange="addonprice(${valueb})" autocomplete="off" name="addon[]" class="form-select" aria-label="Default select example">    <option selected>-</option>
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
            var jml_tiket = $('#jml_tiket').val();
            var lengtseat = seat.children('input').length;
            if (lengtseat < jml_tiket) {
                seat.append("<input type='text' class='text-white' name='seat[]' style='width: 30px; background-color:transparent; border: none;' value='" + $(this).text() + "' readonly='readonly'>")
            } else {
                seat.children('input').last().val($(this).text());
            }
        })

        $('#btn-bayar').on('click', function() {
            $("#submitform").click()
        })

        $(document).on('click', ".list-item-sc", function() {
            var txtdefault = $(".text-date p");
            txtdefault.text($(this).text());
            $('input[name=date]').val($(this).text());
            $('.dropdwn-sc').addClass("invisible");
        });

        $(document).on("click", ".opt-movie", function() {
            var textMovie = $(this).find('span').text();
            $('#movie').val($(this).find('span').text())
            $(".label-tiket").text(textMovie);
            var theater = $('#theater').find('option:selected').attr('id');
            var movie = $(this).attr('id')
            $('input[name=id_movie]').val(movie)
            $.ajax({
                type: "POST",
                url: "{{ route('order.schedules.details') }}",
                data: {
                    theater_id: theater,
                    movie_id: movie,
                    _token: '{{csrf_token()}}'
                },
                success: function(data) {
                    var dateDta = data.playTime[0].date;
                    var strDate = dateDta.split('2023').join('2023 ')
                    var word = strDate.split(' ')
                    $("#list-date").empty();
                    $.each(word, function(index, value) {
                        if (index != word.length) {
                            $("#list-date").append("<li class='list-item-sc bgg'>" + value + "</li>")
                        }
                    })
                    $('input[name=date]').val(word[0])
                    var txtdefault = $(".text-date p");
                    txtdefault.text(word[0]);
                },
                error: function(data, textStatus, errorThrown) {
                    console.log(data);
                },
            });
            $('.dropdown').addClass("invisible");
        });
    });
</script>
@endsection