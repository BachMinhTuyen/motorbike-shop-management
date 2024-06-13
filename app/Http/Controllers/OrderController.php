<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function showAll() {
        $orderList = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->select(
            'customers.fullName',
            'orders.*'
        )
        ->get();
        return view('order', compact('orderList'));
    }
    public function addOrderForm() {
        $fullName = session('user')->fullName;
        $orderId = null;
        $customerPhoneNumber = null;
        $amount = 0;
        $paymentMethod = null;
        return view('addOrder', compact('fullName', 'customerPhoneNumber', 'amount', 'orderId', 'paymentMethod'));
    }
    public function addOrder(Request $request) {
        $user = session('user');
        $fullName = $user->fullName;
        $orderId = $request->input('orderId');
        
        $customerPhoneNumber = $request->input('customerPhoneNumber');
        $customer = DB::table('customers')
        ->where('phoneNumber', $customerPhoneNumber)
        ->exists();

        $voucher = $request->input('voucher');

        $amount = $request->input('amount');
        $paymentMethod = $request->input('paymentMethodRadio');

        $car = DB::table('cars')
        ->where('id', $request->input('productId'))
        ->first();

        $quantity = $request->input('quantity');

        // Trường hợp khách hàng lần đầu mua
        if ($customer == false) {
            // Tạo thông tin khách hàng
            $customerId = DB::table('customers')->insertGetId([
                'fullName' => 'Khách Hàng',
                'dateOfBirth' => now(),
                'phoneNumber' => $customerPhoneNumber,
                'address' => 'TP.HCM',
                'email' => null,
                'created_at' => now(), // Thêm thời gian tạo
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
            $customer = DB::table('customers')
                ->where('id', $customerId)
                ->first();
            //Tạo hóa đơn cho khách hàng và lấy id đơn hàng
            $orderId = DB::table('orders')->insertGetId([
                'customer_id' => $customer->id,
                'user_id' => $user->username,
                'voucher_code' => $voucher,
                'status' => 'Chờ thanh toán',
                'payment_method' => $paymentMethod,
                'amount' => $amount,
                'invoice_date' => now(),
                'created_at' => now(), // Thêm thời gian tạo
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
            //Tạo danh sách sản phẩm chi tiết cho đơn hàng đó
            $order = DB::table('orders')->where('id', $orderId)->first();
            DB::table('order_details')->insert([
                'car_id' => $car->id,
                'order_id' => $order->id,
                'quantity' => $quantity,
                'total' => $car->price * $quantity,
                'created_at' => now(), // Thêm thời gian tạo
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
        }
        else {
            if ($orderId == null) {
                $customer = DB::table('customers')
                    ->where('phoneNumber', $customerPhoneNumber)
                    ->first();
                //Tạo hóa đơn cho khách hàng và lấy id đơn hàng
                $orderId = DB::table('orders')->insertGetId([
                    'customer_id' => $customer->id,
                    'user_id' => $user->username,
                    'voucher_code' => $voucher,
                    'status' => 'Chờ thanh toán',
                    'payment_method' => $paymentMethod,
                    'amount' => $amount,
                    'invoice_date' => now(),
                    'created_at' => now(), // Thêm thời gian tạo
                    'updated_at' => now(), // Thêm thời gian cập nhật
                ]);
                //Tạo danh sách sản phẩm chi tiết cho đơn hàng đó
                $order = DB::table('orders')->where('id', $orderId)->first();
                DB::table('order_details')->insert([
                    'car_id' => $car->id,
                    'order_id' => $order->id,
                    'quantity' => $quantity,
                    'total' => $car->price * $quantity,
                    'created_at' => now(), // Thêm thời gian tạo
                    'updated_at' => now(), // Thêm thời gian cập nhật
                ]);
            }
            else {
                $order = DB::table('orders')->where('id', $orderId)->first();
                $carCheck = DB::table('order_details')
                    ->where('order_id', $order->id)
                    ->where('car_id', $car->id)
                    ->exists();

                $existingOrderDetail = DB::table('order_details')
                ->where('order_id', $order->id)
                ->where('car_id', $car->id)
                ->first();
                
                if ($carCheck) {
                    $newQuantity = $existingOrderDetail->quantity + $quantity;
                    $newTotal = $car->price * $newQuantity;

                    DB::table('order_details')
                    ->where('car_id', $car->id)
                    ->where('order_id', $order->id)
                    ->update([
                        'quantity' => $newQuantity,
                        'total' => $newTotal,
                        'updated_at' => now(), // Thêm thời gian cập nhật
                    ]);
                }
                else{
                    DB::table('order_details')->insert([
                        'car_id' => $car->id,
                        'order_id' => $order->id,
                        'quantity' => $quantity,
                        'total' => $car->price * $quantity,
                        'created_at' => now(), // Thêm thời gian tạo
                        'updated_at' => now(), // Thêm thời gian cập nhật
                    ]);
                }
            }
        }

        $order_details = DB::table('order_details')
        ->join('orders', 'order_details.order_id', '=', 'orders.id')
        ->join('cars', 'cars.id', '=', 'order_details.car_id')
        ->where('order_details.order_id', $orderId)
        ->select(
            'cars.*',
            'order_details.*',
            'orders.*',
        )
        ->get();

        $amount = DB::table('order_details')
            ->where('order_id', $orderId)
            ->sum('total');
            
        DB::table('orders')->where('id', $orderId)->update([
            'voucher_code' => $voucher,
            'amount' => $amount,
            'updated_at' => now(), // Thêm thời gian cập nhật
        ]);

        return view('addOrder', compact('orderId', 'order_details', 'fullName', 'customerPhoneNumber', 'paymentMethod', 'amount'));
    }

    public function detailOrder(string $id) {
        $order = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('orders.id', $id)
        ->select(
            'customers.fullName',
            'customers.phoneNumber',
            'orders.*'
        )
        ->first();
        $orderDetails = DB::table('order_details')
        ->join('cars', 'cars.id', '=', 'order_details.car_id')
        ->where('order_id', $id)
        ->select(
            'cars.id',
            'cars.name',
            'cars.price',
            'order_details.*',
        )
        ->get();
        return view ('details', compact('orderDetails', 'order'));
    }

    public function confirmOrder(string $id) {
        DB::table('orders')
        ->where('id', $id)
        ->update([
            'status' => 'Đã thanh toán',
            'updated_at' => now(), // Thêm thời gian cập nhật
        ]);
        
        $order = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('orders.id', $id)
        ->select(
            'customers.fullName',
            'customers.phoneNumber',
            'orders.*'
        )
        ->first();

        $orderDetails = DB::table('order_details')
        ->join('cars', 'cars.id', '=', 'order_details.car_id')
        ->where('order_id', $id)
        ->select(
            'cars.id',
            'cars.name',
            'cars.price',
            'order_details.*',
        )
        ->get();

        return view ('details', compact('orderDetails', 'order'));
    }
    public function cancelOrder(string $id) {
        DB::table('orders')
        ->where('id', $id)
        ->update([
            'status' => 'Đã hủy',
            'updated_at' => now(), // Thêm thời gian cập nhật
        ]);

        $order = DB::table('orders')
        ->join('customers', 'orders.customer_id', '=', 'customers.id')
        ->where('orders.id', $id)
        ->select(
            'customers.fullName',
            'customers.phoneNumber',
            'orders.*'
        )
        ->first();
        $orderDetails = DB::table('order_details')
        ->join('cars', 'cars.id', '=', 'order_details.car_id')
        ->where('order_id', $id)
        ->select(
            'cars.id',
            'cars.name',
            'cars.price',
            'order_details.*',
        )
        ->get();
        return view ('order_details', compact('orderDetails', 'order'));
    }

    public function detailDelete(string $id) {
        DB::table('order_details')->where('id', $id)->delete();
        return redirect()->back();
    }
}
