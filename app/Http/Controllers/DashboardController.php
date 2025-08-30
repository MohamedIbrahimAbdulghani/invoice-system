<?php

namespace App\Http\Controllers;

use App\Models\invoices;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
public function index() {


//=================احصائية نسبة تنفيذ الحالات======================

    $invoice_count =invoices::count(); //علشان تقدر تجيب عدد كل الفواتير عندك
    $count_invoices1 = invoices::where('value_status', 1)->count(); // علشان تجيب عدد الفواتير الدفوعة
    $count_invoices2 = invoices::where('value_status', 2)->count(); // علشان تجيب عدد الفواتير الغير مدفوعة
    $count_invoices3 = invoices::where('value_status', 3)->count(); // علشان تجيب عدد الفواتير المدفوعة جزئيا

    if($count_invoices1 == 0){
        $present_invoice1 = 0;
    }
    else{
        $present_invoice1 = round(($count_invoices1/ $invoice_count) * 100 ,2); // علشان تجيب النسبة المئوية للفواتير المدفوعة
    }

    if($count_invoices2 == 0){
        $present_invoice2 = 0;
    }
    else{
        $present_invoice2 = round(($count_invoices2 / $invoice_count) * 100, 2); // علشان تجيب النسبة المئوية للفواتير الغير مدفوعة
    }

    if($count_invoices3 == 0){
        $present_invoice3 = 0;
    }
    else{
        $present_invoice3 = round(($count_invoices3/ $invoice_count) * 100 , 2); // علشان تجيب النسبة المئوية للفواتير المدفوعة جزئيا
    }


        $chartjs = app()->chartjs
            ->name('barChartTest')
            ->type('bar')
            ->size(['width' => 350, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    "label" => "الفواتير المدفوعة",
                    'backgroundColor' => ['#81b214'],
                    'data' => [$present_invoice1]
                ],
                [
                    "label" => "الفواتير الغير المدفوعة",
                    'backgroundColor' => ['#ec5858'],
                    'data' => [$present_invoice2]
                ],
                [
                    "label" => "الفواتير المدفوعة جزئيا",
                    'backgroundColor' => ['#ff9642'],
                    'data' => [$present_invoice3]
                ],

            ])
            ->options([
                'legend' => [
                    'display' => true,
                    'labels'=> [
                        'fontColor' => 'black',
                        'fontFamily'=>'Cairo',
                        'fontStyle' => 'bold',
                        'fontSize' => 14,
                    ]
                ]
            ]);


        $chartjs_2 = app()->chartjs
            ->name('pieChartTest')
            ->type('pie')
            ->size(['width' => 340, 'height' => 200])
            ->labels(['الفواتير الغير المدفوعة', 'الفواتير المدفوعة','الفواتير المدفوعة جزئيا'])
            ->datasets([
                [
                    'backgroundColor' => [ '#81b214','#ec5858','#ff9642'],
                    'data' => [$present_invoice1, $present_invoice2,$present_invoice3]
                ]
            ])
            ->options([]);

    return view('dashboard', compact('invoice_count', 'chartjs', 'chartjs_2'));
}


}