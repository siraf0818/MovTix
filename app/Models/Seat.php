<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seat extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $primaryKey = 'id';

    public function order()
    {
        return $this->hasOne(Order::class, 'order_id');
    }
}
