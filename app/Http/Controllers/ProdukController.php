<?php

namespace App\Http\Controllers;

use App\Models\Produks;
use Illuminate\Http\Request;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class ProdukController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $produk = Produks::latest();
        return view('dashboard.produk.index', [
            'produks' => $produk->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.produk.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $request->validate([
            'name_produk' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'image' => 'required|image|file',
        ]);

        // upload image
        $date = date('H-i-s');
        $random = \Str::random(5);
        $image = request('image');
        $path = public_path("upload/produks/" . $date . $random . $image);
        try {
            unlink($path);
        } catch (\Throwable $th) {
        } finally {
            $request->file('image')->move('upload/produks/', $date . $random . $request->file('image')->getClientOriginalName());
            $validate['image'] = $date . $random . $request->file('image')->getClientOriginalName();
        }
        Produks::create($validate);

        return redirect('/admin/produk');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $produk = Produks::find($id);
        return view('dashboard.produk.edit', compact('produk'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $rules = [
            'name_produk' => 'required|max:255',
            'price' => 'required',
            'description' => 'required',
            'stock' => 'required',
            'image' => 'required|image|file',
        ];

        $validateData = $request->validate($rules);

        // update image
        $date = date('H-i-s');
        $random = \Str::random(5);
        $produk = Produks::findOrFail($id);
        $path = public_path("upload/produks/" . $produk->image);
        try {
            unlink($path);
        } catch (\Throwable $th) {
        } finally {
            $request->file('image')->move('upload/produks/', $date . $random . $request->file('image')->getClientOriginalName());
            $rules['image'] = $date . $random . $request->file('image')->getClientOriginalName();
        }
        Produks::where('id', $id)
                ->update($validateData);

        return redirect('/admin/produk');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $produk = Produks::findOrFail($id);
        $path = public_path("upload/produks/" . $produk->image);
        unlink($path);
        Produks::destroy($id);

        return redirect('/admin/produk');
    }

    public function indexproduk()
    {
        $produk = Produks::latest();

        return view('produk', [
            'produks' => $produk->get()
        ]);
    }
    public function showProduk($id)
    {
        $produk = Produks::find($id);

        return view('detail', compact('produk'));
    }
}
