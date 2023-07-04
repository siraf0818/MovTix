<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dashboard extends Model
{
    use HasFactory;

    public static function getRecentOrder()
    {
        $orders = Order::with('user', 'payment')->latest('created_at')->get();
        return $orders;
    }

    public static function getSales()
    {
        $settlement = 'settlement';
        $capture = 'capture';
        $orders = Order::with('payment:order_id,transaction_status,gross_amount')->whereHas('payment', function ($q) use ($settlement, $capture) {
            $q->where('transaction_status', '=', $settlement)->orWhere('transaction_status', '=', $capture);;
        })->get();

        return $orders;
    }

    public static function getEarning()
    {
        $sales = self::getSales();
        $total_earn = 0;

        foreach ($sales as $sale) {
            $total_earn += $sale->payment->gross_amount;
        }

        return $total_earn;
    }

    public static function getNav()
    {
        $navbar = [
            [
                'title' => 'Dashboard',
                'icon' => 'home-outline',
                'link' => '/dashboard'
            ],
            [
                'title' => 'Customers',
                'icon' => 'people-outline',
                'link' => '/dashboard/customers'
            ],
            [
                'title' => 'Theater',
                'icon' => 'film-outline',
                'link' => '/dashboard/theater'
            ],
            [
                'title' => 'Penayangan',
                'icon' => 'film-outline',
                'link' => '/dashboard/penayangan'
            ],
            [
                'title' => 'Addons',
                'icon' => 'fish-outline',
                'link' => '/dashboard/addon'
            ],
            [
                'title' => 'Orders',
                'icon' => 'bag-check-outline',
                'link' => '/dashboard/orders'
            ],
            [
                'title' => 'Sales',
                'icon' => 'cart-outline',
                'link' => '/dashboard/sales'
            ],
            [
                'title' => 'Profile',
                'icon' => 'person-outline',
                'link' => '/dashboard/setting'
            ],
            [
                'title' => 'Password',
                'icon' => 'lock-closed-outline',
                'link' => '/dashboard/password'

            ],
            [
                'title' => 'Sign Out',
                'icon' => 'log-out-outline',
                'link' => '/logout'
            ],
        ];
        return $navbar;
    }

    public static function getNavUser()
    {
        $navbar = [
            [
                'title' => 'Dashboard',
                'icon' => 'home-outline',
                'link' => '/dashboard'
            ],
            [
                'title' => 'Orders',
                'icon' => 'bag-check-outline',
                'link' => '/dashboard/member/orders'
            ],
            [
                'title' => 'Ticket',
                'icon' => 'ticket-outline',
                'link' => '/dashboard/member/tiket'
            ],
            [
                'title' => 'Profile',
                'icon' => 'person-outline',
                'link' => '/dashboard/member/setting'
            ],
            [
                'title' => 'Password',
                'icon' => 'lock-closed-outline',
                'link' => '/dashboard/member/password'

            ],
            [
                'title' => 'Sign Out',
                'icon' => 'log-out-outline',
                'link' => '/logout'
            ],
        ];
        return $navbar;
    }
}
