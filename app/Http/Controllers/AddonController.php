<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Addon;

class AddonController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["title"] = "Products - Online Store";
        $viewData["subtitle"] = "List of products";
        $viewData["addon"] = Addon::all();
        return view('addon.index')->with("viewData", $viewData);
    }

    public function show($id)
    {
        $viewData = [];
        $addon = Addon::findOrFail($id);
        $viewData["title"] = $addon->getName();
        $viewData["subtitle"] = $addon->getName() . " - Addon information";
        $viewData["addon"] = $addon;
        return view('addon.show')->with("viewData", $viewData);
    }
}
