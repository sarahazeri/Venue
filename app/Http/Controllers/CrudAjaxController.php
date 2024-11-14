<?php

namespace App\Http\Controllers;

use App\Models\Venues;

use Illuminate\Http\Request;
use DataTables;

class CrudAjaxController extends Controller
{
    //
    public function index()
    {
        $data = Venues::orderBy('id', 'desc')->get();
        if (request()->ajax()) {
            return datatables()->of($data)
                ->addColumn('Aksi', function ($data) {
                    $button = "
                <button type='button' id='" . $data->id . "' class='update btn btn-warning'  >
                    <i class='fas fa-edit'></i>
                </button>";

                    $button .= "
                <button type='button' id='" . $data->id . "' class='destroy btn btn-danger'>
                    <i class='fas fa-times'></i>
                </button>";

                    return $button;
                })
                ->rawColumns(['Aksi'])
                ->make(true);
        }
        return view('dashboard.crudAjax', compact('data'));
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

        // $notification = array(
        //     'status' => 'success',
        //     'title' => 'Proses berhasil',
        //     'message' => 'Data berhasil ditambahkan'
        // );

        $data = new Venues;
        $data->title = $request->title;
        $data->address = $request->address;
        $data->save();

    }

    public function show(Request $request)
    {
        $id = $request->id;
        $data = Venues::find($id);
        return response()->json(['data' => $data]);
    }

    public function update(Request $request)
    {
        $id = $request->id;
        $update = [
            'title' => $request->title,
            'address' => $request->address
        ];

        $data = Venues::find($id);
        $data->update($update);
        $data->save();

        return response()->json(['data' => $data]);


    }

    public function destroy(Request $request)
    {
        $id = $request->id;
        $data = Venues::find($id);
        $data->delete();

        return response()->json(['data' => $data]);
    }


}
