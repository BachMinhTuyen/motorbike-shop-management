<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function showAll()
    {
        $userList = DB::table('users')
            ->get();
        return view('user', compact('userList'));
    }
    public function profile(string $id)
    {
        $users = DB::table('users')->where('username', $id)->first();
        return response()->json($users);
    }

    public function updateProfile(Request $request) {
        $id = $request->input('id');
        $fullName = $request->input('fullName');
        $dateOfBirth = $request->input('dateOfBirth');
        $phoneNumber = $request->input('phoneNumber');
        $address = $request->input('address');
        $email = $request->input('email');

        DB::table('users')
            ->where('username', $id)
            ->update([
                'fullName' => $fullName,
                'dateOfBirth' => $dateOfBirth,
                'phoneNumber' => $phoneNumber,
                'address' => $address,
                'email' => $email,
                'updated_at' => now(), // Thêm thời gian cập nhật
            ]);
        return redirect()->route('user.userAll');
    }

    public function addUserForm() {
        return view('addUser');
    }

    public function addUser(Request $request) {
        $username = $request->input('username');
        $password = $request->input('password');
        $fullName = $request->input('fullName');
        $dateOfBirth = $request->input('dateOfBirth');
        $phoneNumber = $request->input('phoneNumber');
        $address = $request->input('address');
        $email = $request->input('email');

        DB::table('users')
        ->insert([
            'username' => $username,
            'password' => $password,
            'fullName' => $fullName,
            'dateOfBirth' => $dateOfBirth,
            'phoneNumber' => $phoneNumber,
            'address' => $address,
            'email' => $email,
            'updated_at' => now(),
            'created_at' => now(),
        ]);
        return redirect()->route('user.userAll');
    }
}
