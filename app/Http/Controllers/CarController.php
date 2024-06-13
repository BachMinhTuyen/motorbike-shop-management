<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class CarController extends Controller
{
    public function overview() {
        $carList = DB::table('cars')->get();
        return view('overview', compact('carList'));
    }
    public function showAll() {
        $carList = DB::table('cars')->get();
        return view('home', compact('carList'));
    }
    public function addProductForm() {
        
        return view('addProduct');
    }
    public function addProduct(Request $request) {
        $name = $request->input('name');
        $model = $request->input('model');
        $country = $request->input('country');
        // $year = Carbon::createFromFormat('Y-m-d', $request->input('year') . '-01-01')->startOfDay();
        $year = intval($request->input('year'));
        $warranty = $request->input('warranty');
        $price = $request->input('price');

        $checkExists = DB::table('cars')
        ->where('name', $name)
        ->exists();

        if ($checkExists) {
            return redirect()->back()->withErrors(['product_name' => 'Tên xe đã tồn tại này!'])->withInput();
        }
        DB::table('cars')->insert([
            'name' => $name,
            'country' => $country,
            'model' => $model,
            'year' => $year,
            'warranty_period' => $warranty,
            'price' => $price,
            'created_at' => now(), // Thêm thời gian tạo
            'updated_at' => now(), // Thêm thời gian cập nhật
        ]);
        return redirect()->route('home');
    }
    public function detailProduct(string $id) {
        $product = DB::table('cars')->where('id', $id)->first();
        return response()->json($product);
    }
    public function updateProduct(Request $request) {
        $id = $request->input('id');
        $name = $request->input('name');
        $model = $request->input('model');
        $country = $request->input('country');
        $year = intval($request->input('year'));
        $warranty = $request->input('warranty');
        $price = $request->input('price');

        DB::table('cars')
            ->where('id', $id)
            ->update([
                'name' => $name,
                'country' => $country,
                'model' => $model,
                'year' => $year,
                'warranty_period' => $warranty,
                'price' => $price,
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
        return redirect()->route('home');
    }
    public function deleteProduct(string $id) {
        DB::table('cars')->where('id', $id)->delete();
        return redirect()->route('home');
    }
}
