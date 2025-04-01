<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comic; // Import model Comic
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index()
    {
        // Lấy danh sách sản phẩm từ cơ sở dữ liệu
        $comics = Comic::all(); // Hoặc sử dụng phương thức khác để lấy sản phẩm

        return view('client.index', compact('comics')); // Trả về view với danh sách sản phẩm
    }

    public function show($id)
    {
        $comic = Comic::findOrFail($id); // Tìm sản phẩm theo ID
        return view('client.show', compact('comic')); // Trả về view với sản phẩm chi tiết
    }

    // public function dashboard()
    // {
    //     // Logic cho dashboard
    //     return view('client.dashboard'); // Trả về view dashboard
    // }
}