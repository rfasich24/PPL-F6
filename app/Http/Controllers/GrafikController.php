<?php

namespace App\Http\Controllers;

use App\Models\Expenditures;
use App\Models\Incomes;
use Illuminate\Http\Request;

class GrafikController extends Controller
{
    public function grafik()
    {
        // grafik pendapatan
        $totals = Incomes::select(\DB::raw('cast(sum(incomes.quantity * produks.price) as int) as total'))
                        ->join('produks', 'produks.id', '=', 'incomes.produk_id')
                        ->groupBy(\DB::raw('Month(incomes.date)'))
                        ->pluck('total');
        $bulans = Incomes::select(\DB::raw('monthname(date) as bulan'))
                            ->groupBy(\DB::raw('monthname(date)'))
                            ->pluck('bulan');

        // grafik pengeluaran
        $totalExpenditures = Expenditures::select(\DB::raw('cast(sum(cost) as int) as totalCost'))
                        ->groupBy(\DB::raw('Month(date)'))
                        ->pluck('totalCost');
        $bulanExpenditures = Expenditures::select(\DB::raw('monthname(date) as bulanExpen'))
                            ->groupBy(\DB::raw('monthname(date)'))
                            ->pluck('bulanExpen');


        // grafik profit
        // $profit = [];
        // foreach(array_combine($totals, $totalExpenditures) as $total => $totalExpenditure) {
        //     $resultProfit = $total - $totalExpenditure;
        //     $profit[] = $resultProfit;
        // }

        // dd($profit);

        return view('dashboard.grafik.index', compact('totals', 'bulans', 'totalExpenditures', 'bulanExpenditures'));
    }
}
