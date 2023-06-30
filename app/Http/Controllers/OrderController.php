<?php

namespace App\Http\Controllers;

use App\Models\Movie;
use App\Models\Order;
use App\Models\Seat;
use App\Models\Addon;
use App\Models\User;
use App\Services\Midtrans\CreateSnapTokenService;
use Illuminate\Http\Request;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    //
    public function index()
    {
        $viewData = [];
        $viewData["addon"] = Addon::all();

        $posts = Movie::getMovie();
        return view('order.index', [
            'title' => 'Pembayaran',
            'active' => 'order',
            'posts' => $posts,
            "cities" => Movie::getCities(),
        ])->with("viewData", $viewData);
    }

    public function order(Order $order)
    {
        $order_id = session()->get('order_id');
        $seat = Seat::where('order_id', $order_id)->get();

        $order = Order::find($order_id);
        $ppn = (($order->tiket_price + $order->addon_price) / 100) * 11;

        $movie = Movie::getDetails($order->id_movie);
        return view('order.pay', [
            'title' => "Pembayaran",
            'active' => 'active',
            'order' => $order,
            'seat' => $seat,
            'movie' => $movie,
            'ppn' => $ppn,
            'snap' => $order->snap_token,
        ]);
    }

    public function insertData(Request $request)
    {
        $request['user_id'] = auth()->user()->id;
        $faker = Faker::create('id_ID');
        $order_id = $faker->bothify('?????-#####');
        $request['order_id'] = $order_id;

        $midtrans = new CreateSnapTokenService($request);
        $snapToken = $midtrans->getSnapToken();

        $validatedData = $request->validate([
            'order_id' => 'required',
            'total_price' => 'required',
            'theater' => 'required',
            'date' => 'required',
            'time' => 'required',
            'movie' => 'required',
            'addon' => 'required',
            'jml_addon' => 'required',
            'id_movie' => 'required',
            'jml_tiket' => 'required',
        ]);
        $validatedData['user_id'] = $request->user_id;
        $validatedData['snap_token'] = $snapToken;
        $validatedData['payment_id'] = $order_id;
        $validatedData['seat_id'] = $order_id;

        $id = Order::find($order_id);
        $addono = [];
        foreach ($request->addon as $key => $value) {
            $a = $request->addon[$key];
            $j = $request->jml_addon[$key];
            $addono[] = $a . '(' . $j . ')';
        }

        if ($id == null) {
            Order::create([
                'order_id' => $request->order_id,
                'user_id' => $request->user_id,
                'payment_id' => $order_id,
                'seat_id' => $request->order_id,
                'theater' => $request->theater,
                'date' => $request->date,
                'time' => $request->time,
                'id_movie' => $request->id_movie,
                'movie' => $request->movie,
                'jml_tiket' => $request->jml_tiket,
                'tiket_price' => $request->tiket_price,
                'addon' => implode(' & ', $addono),
                'addon_price' => $request->addon_price,
                'total_price' => $request->total_price,
                'snap_token' => $snapToken,
            ]);

            $seat = array();
            foreach ($request->seat as $item) {
                array_push($seat, [
                    'order_id' => $order_id,
                    'no_seat' => $item,
                    "created_at" =>  date('Y-m-d H:i:s'),
                ]);
            }
            Seat::insert($seat);
        }
        session()->forget('order_id');
        session()->put('order_id', $order_id);
        return redirect('payment');
    }
}
