@extends('layouts.main_dashboard')

@section('content')
<div class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
    <div class="row">
        <div class="col-md-6"><div id="income"></div></div>
        <div class="col-md-6"><div id="expenditure"></div></div>
    </div>
    <div class="row">
        <div class="col">

        </div>
    </div>
</div>
@endsection


@section('script')
    <script src="https://code.highcharts.com/highcharts.js"></script>
    {{-- grafik pendapatan --}}
    <script>
        Highcharts.chart('income', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pendapatan'
        },
        xAxis: {
            categories: {!! json_encode($bulans) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Income (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Income',
            data: {!! json_encode($totals) !!}
        }]
    });
    </script>
    {{-- grafik pengeluaran --}}
    <script>
        Highcharts.chart('expenditure', {
        chart: {
            type: 'column'
        },
        title: {
            text: 'Grafik Pengeluaran'
        },
        xAxis: {
            categories: {!! json_encode($bulanExpenditures) !!},
            crosshair: true
        },
        yAxis: {
            min: 0,
            title: {
                text: 'Expenditure (Rp)'
            }
        },
        tooltip: {
            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                '<td style="padding:0"><b>Rp. {point.y:.1f}</b></td></tr>',
            footerFormat: '</table>',
            shared: true,
            useHTML: true
        },
        plotOptions: {
            column: {
                pointPadding: 0.2,
                borderWidth: 0
            }
        },
        series: [{
            name: 'Expenditure',
            data: {!! json_encode($totalExpenditures) !!}
        }]
    });
    </script>
@endsection
