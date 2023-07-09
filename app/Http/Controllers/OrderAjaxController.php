<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Payment;
use App\Models\Addon;
use App\Models\Penayangan;
use Illuminate\Http\Request;

class OrderAjaxController extends Controller
{
    public function dates(Request $request)
    {
        $dates = Penayangan::getDateDtl($request->movie_id);
        return $dates;
    }

    public function times(Request $request)
    {
        $times = Penayangan::getTimeDtl($request->movie_id, $request->date);
        return $times;
    }

    public function theaters(Request $request)
    {
        $theaters = Penayangan::getTheaterDtl($request->movie_id, $request->date, $request->time);
        return $theaters;
    }

    public function prices(Request $request)
    {
        $prices = Penayangan::getPriceDtl($request->movie_id, $request->date, $request->time, $request->theater);
        return $prices;
    }

    public function seats(Request $request)
    {
        $seats = Penayangan::getSeatDtl($request->penayangan_id);
        return $seats;
    }

    public function pendingPayment(Request $request)
    {
        return Payment::pending($request);
    }

    public function successPayment(Request $request)
    {
        return Payment::success($request);
    }
}
