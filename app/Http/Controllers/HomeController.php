<?php

namespace App\Http\Controllers;

use App\Models\DescriptionHome;
use App\Models\Jumbotrons;
use App\Models\ProdukHome;
use App\Models\SuggestionHome;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    // public function __construct()
    // {
    //     $this->middleware('auth');
    // }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $description = DescriptionHome::latest();
        $jumbotron = Jumbotrons::latest();
        $produkHome = ProdukHome::latest();
        $suggestionHome = SuggestionHome::latest();
        return view('home', [
            'jumbotrons' => $jumbotron->get(),
            'produkHomes' => $produkHome->get(),
            'suggestionHomes' => $suggestionHome->get(),
            'descriptions' =>$description->get()
        ]);
    }

    public function adminHome()
    {
        $description = DescriptionHome::latest();
        $jumbotron = Jumbotrons::latest();
        $produkHome = ProdukHome::latest();
        $suggestionHome = SuggestionHome::latest();
        return view('dashboard.homepage.index', [
            'jumbotrons' => $jumbotron->get(),
            'produkHomes' => $produkHome->get(),
            'suggestionHomes' => $suggestionHome->get(),
            'descriptions' =>$description->get()
        ]);
    }

    public function edit($id)
    {

    }
    // update description home
    public function updateDescription(Request $request, $id)
    {
        $rules = [
            'description_home' => 'required|max:255',
        ];

        $validateData = $request->validate($rules);

        DescriptionHome::where('id', $id)
                ->update($validateData);

        return redirect('/admin');
    }
    // update jumbotron image
    public function createJumbotron(Request $request)
    {
        // dd(request('image_description'));
        $rules = [
            'image_description' => 'image|file',
        ];

        $validateData = $request->validate($rules);

        $date = date('H-i-s');
        $random = \Str::random(5);
        $image = request('image_description');
        $path = public_path("upload/home/" . $date . $random . $image);
        try {
            unlink($path);
        } catch (\Throwable $th) {
        } finally {
            $request->file('image_description')->move('upload/home/', $date . $random . $image->getClientOriginalName());
            $validateData['image_description'] = $date . $random . $image->getClientOriginalName();
        }

        Jumbotrons::create($validateData);

        return redirect('/admin');
    }
    public function destroyJumbotron($id)
    {
        $jumbotron = Jumbotrons::findOrFail($id);
        $path = public_path("upload/home/" . $jumbotron->image_description);
        unlink($path);
        Jumbotrons::destroy($id);

        return redirect('/admin');
    }
    // update produk image
    public function createProduk(Request $request)
    {
        $rules = [
            'image_produk' => 'image|file',
        ];

        $validateData = $request->validate($rules);

        $date = date('H-i-s');
        $random = \Str::random(5);
        $image = request('image_produk');
        $path = public_path("upload/home/" . $date . $random . $image);
        try {
            unlink($path);
        } catch (\Throwable $th) {
        } finally {
            $request->file('image_produk')->move('upload/home/', $date . $random . $request->file('image_produk')->getClientOriginalName());
            $validateData['image_produk'] = $date . $random . $request->file('image_produk')->getClientOriginalName();
        }

        ProdukHome::create($validateData);

        return redirect('/admin');
    }
    public function destroyProduk($id)
    {
        $produk = ProdukHome::findOrFail($id);
        $path = public_path("upload/home/" . $produk->image_produk);
        unlink($path);
        ProdukHome::destroy($id);

        return redirect('/admin');
    }
    // update suggestion image
    public function createSuggestion(Request $request)
    {
        $rules = [
            'image_suggestion' => 'image|file',
        ];

        $validateData = $request->validate($rules);

        $date = date('H-i-s');
        $random = \Str::random(5);
        $image = request('image_suggestion');
        $path = public_path("upload/home/" . $date . $random . $image);
        try {
            unlink($path);
        } catch (\Throwable $th) {
        } finally {
            $request->file('image_suggestion')->move('upload/home/', $date . $random . $request->file('image_suggestion')->getClientOriginalName());
            $validateData['image_suggestion'] = $date . $random . $request->file('image_suggestion')->getClientOriginalName();
        }

        SuggestionHome::create($validateData);

        return redirect('/admin');
    }
    public function destroySuggestion($id)
    {
        $suggestion = SuggestionHome::findOrFail($id);
        $path = public_path("upload/home/" . $suggestion->image_suggestion);
        unlink($path);
        SuggestionHome::destroy($id);

        return redirect('/admin');
    }
}
