<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Theater extends Model
{
    public static function validate($request)
    {
        $request->validate([
            "id" => "required", "name" => "required", "status" => "required",
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

    public function getCode()
    {
        return $this->attributes['code'];
    }

    public function setCode($id)
    {
        $this->attributes['code'] = $id;
    }

    public function getName()
    {
        return $this->attributes['name'];
    }

    public function setName($name)
    {
        $this->attributes['name'] = $name;
    }

    public function getStatus()
    {
        return $this->attributes['status'];
    }

    public function setStatus($status)
    {
        $this->attributes['status'] = $status;
    }

    public static function getAvail()
    {
        $viewData = [];
        $viewData = Theater::all()->where('status', 'Available');
        return $viewData;
    }
}
