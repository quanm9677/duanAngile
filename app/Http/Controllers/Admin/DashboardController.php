<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Comic;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $stats = [
            'total_categories' => Category::count(),
            'total_comics' => Comic::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('stats'));
    }

    public function dashboard()
    {
        return view('admin.dashboard.index');
    }
}