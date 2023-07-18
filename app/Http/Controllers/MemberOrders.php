<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use App\Models\Order;
use Illuminate\Http\Request;

class MemberOrders extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $listnavitem = Dashboard::getNavUser();
        $auth = auth()->user();
        $orders = Dashboard::getRecentOrder();
        $ordersMember = Order::with('user', 'payment')->where('user_id', '=', auth()->user()->id)->latest('created_at')->paginate(6);

        return view('dashboard.member.order.index', [
            'title' => 'Orders',
            'listnav' => $listnavitem,
            'auth' => $auth,
            'orders' => $ordersMember,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $listnavitem = Dashboard::getNavUser();
        $auth = auth()->user();
        $details = Dashboard::getRecentOrder()->where('order_id', '=', $id)->first();

        $ppn = (($details->tiket_price + $details->addon_price) / 100) * 11;
        $price = floor($details->tiket_price + $details->addon_price);

        return view('dashboard.admin.sales.show', [
            'title' => 'Details Order',
            'listnav' => $listnavitem,
            'auth' => $auth,
            'detail' => $details,
            'ppn' => $ppn,
            'price' => $price
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $order = Order::where('order_id', '=', $id)->first();
        Order::destroy($order->order_id);
        return back()->with('messege', 'Order has been deleted!');
    }
}
