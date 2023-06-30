<?php

namespace App\Http\Controllers;

use App\Models\Addon;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use Illuminate\Support\Facades\Storage;

class AdminAddonController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["addon"] = Addon::all();
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();

        return view('dashboard.admin.addon.index', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }
    public function store(Request $request)
    {
        Addon::validate($request);
        $newAddon = new Addon();
        $newAddon->setName($request->input('name'));
        $newAddon->setDescription($request->input('description'));
        $newAddon->setPrice($request->input('price'));
        $newAddon->setImage("game.png");
        $newAddon->save();
        if ($request->hasFile('image')) {
            $imageName = $newAddon->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $newAddon->setImage($imageName);
            $newAddon->save();
        }
        return back();
    }
    public function delete($id)
    {
        Addon::destroy($id);
        return back();
    }
    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Addon";
        $viewData["addon"] = Addon::findOrFail($id);
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();
        return view('dashboard.admin.addon.edit', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }
    public function update(Request $request, $id)
    {
        Addon::validate($request);
        $addon = Addon::findOrFail($id);
        $addon->setName($request->input('name'));
        $addon->setDescription($request->input('description'));
        $addon->setPrice($request->input('price'));
        if ($request->hasFile('image')) {
            $imageName = $addon->getId() . "." . $request->file('image')->extension();
            Storage::disk('public')->put(
                $imageName,
                file_get_contents($request->file('image')->getRealPath())
            );
            $addon->setImage($imageName);
        }
        $addon->save();
        return redirect()->route('dashboard.admin.addon.index');
    }
}
