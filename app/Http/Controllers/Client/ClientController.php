<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comic; // Import model Comic
use App\Models\Category; // Import model Category
use Illuminate\Http\Request;

class ClientController extends Controller
{
    public function index(Request $request)
    {
        $categories = Category::all(); // Lấy danh sách danh mục từ database
        $comics = Comic::all(); // Lấy danh sách sản phẩm (hoặc theo cách bạn đang lấy)
        // $query = Comic::query();

        // // Kiểm tra nếu có từ khóa tìm kiếm
        // if ($request->has('search') && $request->input('search') != '') {
        //     $search = $request->input('search');
        //     $query->where('title', 'LIKE', "%{$search}%"); // Tìm kiếm theo tiêu đề sản phẩm
        // }

        return view('client.index', compact('comics', 'categories')); // Trả về view với danh sách sản phẩm
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

    public function search(Request $request)
    {
        $query = $request->input('query');
    
        // Tìm sản phẩm theo ID hoặc tên
        $comic = Comic::where('id', $query)
            ->orWhere('title', 'LIKE', "%{$query}%")
            ->first(); // Lấy sản phẩm đầu tiên phù hợp
    
        if ($comic) {
            // Chuyển hướng đến trang chi tiết sản phẩm
            return redirect()->route('client.show', $comic->id);
        }
    
        // Nếu không tìm thấy sản phẩm, thêm thông báo vào session
        return redirect()->route('client.products.index')->with('error', 'Sản phẩm không tìm thấy.');
    }

    // public function dashboard()
    // {
    //     // Logic cho dashboard
    //     return view('client.dashboard'); // Trả về view dashboard
    // }
}
