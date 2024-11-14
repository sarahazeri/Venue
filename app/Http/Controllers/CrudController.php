<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Venues;

class CrudController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware(['auth:sanctum', 'verified']);
    }

    public function index()
    {
        $venues = Venues::orderBy('id', 'desc')->get();
        return view('dashboard.crud', compact('venues'));
    }

    public function store(Request $request)
    {

        $request->validate([
            'title' => 'required',
            'address' => 'required',
        ], [
            'title.required' => 'Title tidak boleh kosong',
            'address.required' => 'Address tidak boleh kosong',
        ]);

        $data = new Venues;
        $data->title = $request->title;
        $data->address = $request->address;
        $data->save();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil ditambahkan'
        );

        return Redirect()->back()->with($notification);

    }

    public function update(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'address' => 'required',
        ], [
            'title.required' => 'Title tidak boleh kosong',
            'address.required' => 'Address tidak boleh kosong',
        ]);
        $data = Venues::find($request->id);
        $data->title = $request->title;
        $data->address = $request->address;
        $data->save();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil diperbaharui'
        );

        return Redirect()->back()->with($notification);

    }

    public function destroy(Request $request)
    {
        $data = Venues::find($request->id);
        $data->delete();

        $notification = array(
            'status' => 'success',
            'title' => 'Proses berhasil',
            'message' => 'Data berhasil dihapus'
        );
        return Redirect()->back()->with($notification);
    }
}
