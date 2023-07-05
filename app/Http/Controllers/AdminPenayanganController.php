<?php

namespace App\Http\Controllers;

use App\Models\Penayangan;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Dashboard;
use App\Models\Movie;
use App\Models\Theater;

use Illuminate\Support\Facades\Storage;

class AdminPenayanganController extends Controller
{
    public function index()
    {
        $viewData = [];
        $viewData["penayangan"] = Penayangan::all();
        $viewData["theater"] = Theater::getAvail();
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();
        $posts = Movie::getMovie();

        return view('dashboard.admin.penayangan.index', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'posts' => $posts,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }

    public function store(Request $request)
    {
        Penayangan::validate($request);
        $newPenayangan = new Penayangan();
        $newPenayangan->setId($request->input('id'));
        $newPenayangan->setTheater($request->input('theater'));
        $newPenayangan->setDate($request->input('date'));
        $newPenayangan->setTime($request->input('time'));
        $newPenayangan->setIdMovie($request->input('id_movie'));
        $newPenayangan->setMovie($request->input('movie'));
        $newPenayangan->setPrice($request->input('price'));
        $newPenayangan->save();
        return back();
    }

    public function delete($id)
    {
        Penayangan::destroy($id);
        return back();
    }

    public function edit($id)
    {
        $viewData = [];
        $viewData["title"] = "Admin Page - Edit Penayangan";
        $viewData["penayangan"] = Penayangan::findOrFail($id);
        $posts = Movie::getMovie();
        $listnavitem = Dashboard::getNav();
        $auth = auth()->user();
        return view('dashboard.admin.penayangan.edit', [
            'title' => 'Dashboard',
            'listnav' => $listnavitem,
            'posts' => $posts,
            'auth' => $auth,
        ])->with("viewData", $viewData);
    }

    public function update(Request $request, $id)
    {
        Penayangan::validate($request);
        $penayangan = Penayangan::findOrFail($id);
        $penayangan->setId($request->input('id'));
        $penayangan->setTheater($request->input('theater'));
        $penayangan->setDate($request->input('date'));
        $penayangan->setTime($request->input('time'));
        $penayangan->setIdMovie($request->input('id_movie'));
        $penayangan->setMovie($request->input('movie'));
        $penayangan->setPrice($request->input('price'));
        $penayangan->save();
        return redirect()->route('dashboard.admin.penayangan.index');
    }
}
