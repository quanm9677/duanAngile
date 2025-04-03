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
        // Tìm sản phẩm theo ID
        $comic = Comic::findOrFail($id);
        
        // Tăng số lần click
        $comic->increment('click_count'); // Tăng click_count
        
        // Đánh dấu sản phẩm là được xem
        $comic->is_featured = true; // Đánh dấu là sản phẩm nổi bật
        $comic->save(); // Lưu thay đổi vào cơ sở dữ liệu
        
        // Trả về view chi tiết sản phẩm
        return view('client.show', compact('comic'));
    }

    // public function dashboard()
    // {
    //     // Logic cho dashboard
    //     return view('client.dashboard'); // Trả về view dashboard
    // }
}