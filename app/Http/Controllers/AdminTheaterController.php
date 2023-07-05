<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Theater;
use App\Models\Dashboard;
use App\Http\Controllers\Controller;

class AdminTheaterController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["theater"] = Theater::all();
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();

        return view('dashboard.admin.theater.index', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Theater::validate($request);
        $newTheater = new Theater();
        $newTheater->setId($request->input('id'));
        $newTheater->setCode($request->input('id'));
        $newTheater->setName($request->input('name'));
        $newTheater->setStatus($request->input('status'));
        $newTheater->save();
        return back();
    }

    public function delete($id)
    {
        Theater::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit theater";
        $viewData["theater"] = Theater::findOrFail($id);
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();
        return view('dashboard.admin.theater.edit', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Theater::validate($request);
        $theater = Theater::findOrFail($id);
        $theater->setId($request->input('id'));
        $theater->setCode($request->input('id'));
        $theater->setName($request->input('name'));
        $theater->setStatus($request->input('status'));
        $theater->save();
        return redirect()->route('dashboard.admin.theater.index');
    }
}
