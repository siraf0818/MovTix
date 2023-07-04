<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penayangan extends Model
{
    public $incrementing = false;
    protected $primaryKey = 'id';

    public static function validate($request)
    {
        $request->validate([
            "id" => "unique:penayangans", "time" => "required", "date" => "required", "theater" => "required", "price" => "required|numeric|gt:0",
        ]);
    }

    public function getId()
    {
        return $this->attributes['id'];
    }

    public function setId($id)
    {
        $this->attributes['id'] = $id;
    }

    public function getTheater()
    {
        return $this->attributes['theater'];
    }

    public function setTheater($theater)
    {
        $this->attributes['theater'] = $theater;
    }

    public function getDate()
    {
        return $this->attributes['date'];
    }

    public function setDate($date)
    {
        $this->attributes['date'] = $date;
    }

    public function getTime()
    {
        return $this->attributes['time'];
    }

    public function setTime($time)
    {
        $this->attributes['time'] = $time;
    }

    public function getIdMovie()
    {
        return $this->attributes['id_movie'];
    }

    public function setIdMovie($id)
    {
        $this->attributes['id_movie'] = $id;
    }

    public function getMovie()
    {
        return $this->attributes['movie'];
    }

    public function setMovie($movie)
    {
        $this->attributes['movie'] = $movie;
    }
    public function getPrice()
    {
        return $this->attributes['tiket_price'];
    }

    public function setPrice($price)
    {
        $this->attributes['tiket_price'] = $price;
    }

    public function getCreatedAt()
    {
        return $this->attributes['created_at'];
    }

    public function setCreatedAt($createdAt)
    {
        $this->attributes['created_at'] = $createdAt;
    }

    public function getUpdatedAt()
    {
        return $this->attributes['updated_at'];
    }

    public function setUpdatedAt($updatedAt)
    {
        $this->attributes['updated_at'] = $updatedAt;
    }
    public function items()
    {
        return $this->hasMany(Item::class);
    }

    public function getItems()
    {
        return $this->items;
    }

    public function setItems($items)
    {
        $this->items = $items;
    }

    public static function penayanganDetails()
    {
        $viewMov = [];
        $viewData = [];
        $viewData = Penayangan::select('id_movie')->distinct()->get();
        foreach ($viewData as $key => $value) {
            $viewMov[] = Movie::getDetails($value->id_movie);
        }
        return $viewMov;
    }

    public static function getDateDtl($movie_id)
    {
        $viewData = [];
        $viewData = Penayangan::select('date')->where('id_movie', $movie_id)->distinct()->pluck('date')->toArray();
        return $viewData;
    }
    public static function getTimeDtl($movie_id, $date)
    {
        $viewData = [];
        $viewData = Penayangan::select('time')->where('id_movie', $movie_id)->where('date', $date)->distinct()->pluck('time')->toArray();
        return $viewData;
    }
    public static function getTheaterDtl($movie_id, $date, $time)
    {
        $viewData = [];
        $viewData = Penayangan::select('theater')->where('id_movie', $movie_id)->where('date', $date)->where('time', $time)->distinct()->pluck('theater')->toArray();
        return $viewData;
    }
    public static function getPriceDtl($movie_id, $date, $time, $theater)
    {
        $viewData = [];
        $viewData = Penayangan::select('tiket_price')->where('id_movie', $movie_id)->where('date', $date)->where('time', $time)->where('theater', $theater)->distinct()->pluck('tiket_price')->toArray();
        return $viewData;
    }
    public static function getIdDtl($movie_id, $date, $time, $theater)
    {
        $viewData = [];
        $viewData = Penayangan::select('id')->where('id_movie', $movie_id)->where('date', $date)->where('time', $time)->where('theater', $theater)->distinct()->pluck('id')->toArray();
        return $viewData;
    }
    public static function getSeatDtl($penayangan_id)
    {
        $viewData = [];
        $viewData = Seat::select('no_seat')->where('penayangan_id', $penayangan_id)->distinct()->pluck('no_seat')->toArray();
        return $viewData;
    }
}
