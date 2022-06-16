<?php

namespace App\Http\Controllers;

use App\Models\Incomes;
use App\Models\Produks;
use App\Models\Expenditures;
use Illuminate\Http\Request;

class IncomeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $income = Incomes::select([
            \DB::raw('(produks.price * incomes.quantity) as totalPrice'),
            'produks.name_produk',
            'produks.price',
            'incomes.id',
            'incomes.quantity',
            'incomes.date'
        ])
            ->join('produks', 'produks.id', '=', 'incomes.produk_id')
            ->latest('incomes.created_at');
        // $incomeTotal = Incomes::select([\DB::raw('(sum(produks.price * incomes.quantity) as total)')])
        //                         ->join('produks', 'produks.id', '=', 'incomes.produk_id')
        //                         ->groupBy(\DB::raw('Month(incomes.date)'));
        // $totalExpenditures = Expenditures::sum('cost');
        // $totalIncome = Incomes::with('produk')->sum('quantity * produk.price');

        $totalIncome = Incomes::select(\DB::raw('SUM(produks.price *incomes.quantity ) As total'))
            ->join('produks', 'produks.id', '=', 'incomes.produk_id')
            ->get();

        // return response()->json([
        //     $totalIncome
        // ], 200);

        return view('dashboard.rekapitulasi.pendapatan.index', [
            'incomes' => $income->get(),
            'total' => $totalIncome,

            // 'incomeTotals' =>$incomeTotal->get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $produk = Produks::latest();
        return view('dashboard.rekapitulasi.pendapatan.add', [
            'produks' => $produk->get()
        ]);
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
            'produk_id' => 'required',
            'quantity' => 'required|numeric',
            'date' => 'required|date',
        ]);
        $produk = Produks::find(request('produk_id'));
        $stockMin = $produk->stock - request('quantity');
        Produks::select('stock')
                ->where('id', request('produk_id'))
                ->update(array('stock' => $stockMin));
        Incomes::create($validate);

        return redirect('/admin/incomes');
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
        $produk = Produks::latest();
        $income = Incomes::join('produks', 'produks.id', '=', 'incomes.produk_id')
            ->find($id);
        return view('dashboard.rekapitulasi.pendapatan.edit', compact('income'), [
            'produks' => $produk->get()
        ]);
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
            'produk_id' => 'required|max:255',
            'quantity' => 'required',
            'date' => 'required',
        ];

        $validateData = $request->validate($rules);

        Incomes::where('id', $id)
            ->update($validateData);

        // return redirect();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Incomes::destroy($id);
    }
}
