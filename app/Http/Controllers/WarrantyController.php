<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class WarrantyController extends Controller
{
    public function showAll() {
        $list = DB::table('guarantees')
        ->join('order_details', 'guarantees.order_detail_id', '=', 'order_details.id')
        ->join('cars', 'cars.id', '=', 'order_details.car_id')
        ->select(
            'order_details.order_id',
            'cars.*',
            'guarantees.*',
        )
        ->get();
        return view('warranty', compact('list'));
    }
}
