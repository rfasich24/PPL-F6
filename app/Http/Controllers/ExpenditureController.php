<?php

namespace App\Http\Controllers;

use App\Models\Expenditures;
use Illuminate\Http\Request;

class ExpenditureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $expenditure = Expenditures::latest();
        $totalExpenditures = Expenditures::sum('cost');
        return view('dashboard.rekapitulasi.pengeluaran.index', [
            'expenditures' => $expenditure->get(),
            'totalExpenditures' => $totalExpenditures
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.rekapitulasi.pengeluaran.add');
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
            'description' => 'required',
            'cost' => 'required',
            'date' => 'required|date',
        ]);

        Expenditures::create($validate);

        return redirect('/admin/expenditures');
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
        $expenditure = Expenditures::find($id);

        return view('dashboard.rekapitulasi.pengeluaran.edit', compact('expenditure'));
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
            'description' => 'required',
            'cost' => 'required',
            'date' => 'required|date',
        ];

        $validateData = $request->validate($rules);

        Expenditures::where('id', $id)
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
        Expenditures::destroy($id);

        return redirect('/admin/expenditures');
    }
}
