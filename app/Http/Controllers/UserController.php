<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
// use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function show($id)
    {
        return User::findOrFail($id);
    }

    public function index()
    {
        $users = User::
            join('departments', 'users.department_id', '=', 'departments.id')
            ->join('users_status', 'users.status_id', '=', 'users_status.id')
            ->select(
                'users.*', 
                'departments.name as departments', 
                'users_status.name as status'
            )
            ->get();

        return response()->json($users);
    }

    public function create()
    {
        $users_status = \DB::table("users_status")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();
        
        $departments = \DB::table("departments")
            ->select(
                "id as value",
                "name as label"
            )
            ->get();

        return response()->json([
            "users_status" => $users_status,
            "departments" => $departments
        ]);
    }

    public function store(Request $request)
    {
        // $validated = $request->validate([
        //     "status_id" => "required",
        //     "username" => "required|unique:users,username",
        //     "name" => "required|max:255",
        //     "email" => "required|email",
        //     "department_id" => "required",
        //     "password" => "required|confirmed"
        // ], [
        //     "status_id.required" => "Nhập Tình trạng",
        //     "username.required" => "Nhập Tên Tài khoản",
        //     "username.unique" => "Tên Tài khoản đã tồn tại",

        //     "name.required" => "Nhập Họ và Tên",
        //     "name.max" => "Ký tự tối đa là 255",

        //     "email.required" => "Nhập Email",
        //     "email.email" => "Email không hợp lệ",

        //     "department_id.required" => "Nhập Phòng ban",
        //     "password.required" => "Nhập Mật khẩu",
        //     "password.confirmed" => "Mật khẩu và Xác nhận mật khẩu không khớp"
        // ]);
        
        return $request["status_id"];

        // Eloquent ORM
        // User::create([
            
        // ]);
    }
}
