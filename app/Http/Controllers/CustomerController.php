<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CustomerController extends Controller
{
    public function showAll()
    {
        $customerList = DB::table('customers')
            ->get();
        return view('customer', compact('customerList'));
    }
    public function profile(string $id)
    {
        $customers = DB::table('customers')->where('id', $id)->first();
        return response()->json($customers);
    }

    public function updateProfile(Request $request) {
        $id = $request->input('id');
        $customerName = $request->input('fullName');
        $dateOfBirth = $request->input('dateOfBirth');
        $phoneNumber = $request->input('phoneNumber');
        $address = intval($request->input('address'));
        $email = $request->input('email');

        DB::table('customers')
            ->where('id', $id)
            ->update([
                'fullName' => $customerName,
                'dateOfBirth' => $dateOfBirth,
                'phoneNumber' => $phoneNumber,
                'address' => $address,
                'email' => $email,
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
        return redirect()->route('customer.customerAll');
    }
}
