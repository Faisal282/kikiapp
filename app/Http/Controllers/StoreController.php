<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Store as Store;

class StoreController extends Controller
{
    public function __construct() {
        $this->middleware("auth");
    }

    public function index()
    {
        $stores = Store::paginate(1);
        return view('admin.motor.index', compact('stores'));
    }

    public function create()
    {
        return view('store.tambah'); 
    }

    public function store(Request $request) //berfungsi insert data
    {
        $this->validate($request, [
            'nama' => 'required',
            'brand' => 'required',
            'tahun' => 'required',
            'jenis' => 'required',
            'asal' => 'required',
            'gambar' => 'required'
        ]);

        $store = new Store;
        $store->nama = $request->nama;
        $store->brand = $request->brand;
        $store->tahun = $request->tahun;
        $store->jenis = $request->jenis;
        $store->asal = $request->asal;
        $store->gambar = $request->gambar;
        $store->save();

        return redirect('/store');
    }

    public function show($id) // method get -> berfungsi menampilkan detail barang
    {
        $store = Store::find($id);

        if (!store) {
            abort(404);
        }

        return view('store.detail', compact('store'));
    }

    public function edit($id) // method put -> berfungsi menampilkan detail barang sebelum diedit
    {
        $store = Store::find($id);

        if (!store) {
            abort(404);
        }

        return view('store.edit', compact('store'));
    }

    public function update(Request $request, $id) //method put->berfungsi mengupdate
    {
        $store = Store::find('id', $id);
        $store->nama = $request->nama;
        $store->brand = $request->brand;
        $store->tahun = $request->tahun;
        $store->jenis = $request->jenis;
        $store->asal = $request->asal;
        $store->save();

    }
   
    public function destroy($id)
    {
        $store = Store::find('id', $id)->delete();
        return redirect('/store');
    }
}
