<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;

class DashboardController extends Controller
{
    public function index()
    {
        // Thêm logic lấy dữ liệu thống kê ở đây nếu cần
        return view('admin.dashboard');
    }
}