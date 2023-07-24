<?php

namespace App\Http\Controllers;

use App\Models\Dashboard;
use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\User;
use App\Models\Penayangan;
use App\Models\Addon;
use App\Models\Theater;

class AjaxController extends Controller
{
    public function ajaxSearch(Request $request)
    {
        $title = $request->data;
        if ($request->url == '/dashboard/customers') {
            $customer = User::all()->filter(function ($item) use ($title) {
                return false !== stristr($item['username'], $title) || false !== stristr($item['name'], $title) || false !== stristr($item['email'], $title) || false !== stristr($item['no_telphone'], $title) || false !== stristr($item['address'], $title);
            });
            return $customer;
        } elseif ($request->url == '/dashboard/orders') {
            $orders = Dashboard::getRecentOrder()->filter(function ($item) use ($title) {
                if ($item->payment != null) {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title) || false !== stristr($item->payment->transaction_status, $title);
                } else {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title);
                }
            });

            return $orders;
        } elseif ($request->url == '/dashboard/sales') {
            $sales = Dashboard::getRecentOrder()->filter(function ($item) use ($title) {
                if ($item->payment != null) {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title) || false !== stristr($item->payment->transaction_status, $title) || false !== stristr($item->payment->payment_type, $title);
                } else {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title);
                }
            });

            return $sales;
        } elseif ($request->url == '/dashboard/member/orders') {
            $orders = Dashboard::getRecentOrder()->where('user_id', '=', auth()->user()->id)->filter(function ($item) use ($title) {
                if ($item->payment != null) {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title) || false !== stristr($item->payment->transaction_status, $title);
                } else {
                    return false !== stristr($item->user->name, $title) || false !== stristr($item->user->email, $title) || false !== stristr($item->order_id, $title) || false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title);
                }
            });
            return $orders;
        } elseif ($request->url == '/dashboard/member/tiket') {
            $tikets = Dashboard::getRecentOrder()->where('user_id', '=', auth()->user()->id)->filter(function ($item) use ($title) {
                if ($item->payment != null) {
                    return false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title);
                } else {
                    return false !== stristr($item->movie, $title) || false !== stristr($item->date, $title) || false !== stristr($item->time, $title) || false !== stristr($item->total_price, $title);
                }
            });
            return $tikets;
        } elseif ($request->url == '/dashboard/addon') {
            $addon = Addon::all()->filter(function ($item) use ($title) {
                return false !== stristr($item['name'], $title) || false !== stristr($item['description'], $title) || false !== stristr($item['price'], $title);
            });
            return $addon;
        } elseif ($request->url == '/dashboard/penayangan') {
            $penayangan = Penayangan::all()->filter(function ($item) use ($title) {
                return false !== stristr($item['id'], $title) || false !== stristr($item['theater'], $title) || false !== stristr($item['date'], $title) || false !== stristr($item['time'], $title) ||  false !== stristr($item['movie'], $title) || false !== stristr($item['tiket_price'], $title);
            });
            return $penayangan;
        } elseif ($request->url == '/dashboard/theater') {
            $theater = Theater::all()->filter(function ($item) use ($title) {
                return false !== stristr($item['code'], $title) || false !== stristr($item['name'], $title) || false !== stristr($item['status'], $title);
            });
            return $theater;
        }
    }
}
