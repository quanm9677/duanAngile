<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Comic; // Import model Comic
use App\Models\Category; // Import model Category
use Illuminate\Http\Request;

class ClientController extends Controller
{
   // ... existing code ...
public function index(Request $request)
{
    $categories = Category::all(); // Lấy danh sách danh mục

    // Khởi tạo truy vấn cho sản phẩm
    $comics = Comic::query();

    // Lọc theo danh mục nếu có
    if ($request->filled('category_id')) {
        $comics->where('category_id', $request->category_id);
    }

    // Lọc theo khoảng giá nếu có
    if ($request->filled('price_range')) {
        $priceRange = explode('-', $request->price_range);
        $comics->whereBetween('price', [$priceRange[0], $priceRange[1]]);
    }

    // Lấy tất cả sản phẩm và sắp xếp theo click_count giảm dần
    $comics = $comics->orderBy('click_count', 'desc')->get();

    // Kiểm tra nếu có từ khóa tìm kiếm
    if ($request->filled('query')) {
        // Tìm sản phẩm đầu tiên khớp với từ khóa
        $comic = Comic::where('title', 'like', '%' . $request->input('query') . '%')->first();

        // Nếu tìm thấy sản phẩm, chuyển hướng đến trang chi tiết
        if ($comic) {
            return redirect()->route('client.show', $comic->id);
        } else {
            // Nếu không tìm thấy sản phẩm, có thể trả về thông báo
            return redirect()->route('client.index')->with('error', 'Không tìm thấy sản phẩm nào.')->with(compact('categories', 'comics'));
        }
    }

    return view('client.index', compact('comics', 'categories')); // Truyền danh sách sản phẩm và danh mục vào view
}
// ... existing code ...

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

    // public function search(Request $request)
    // {
    //     $query = $request->input('query');
    
    //     // Tìm sản phẩm theo ID hoặc tên
    //     $comic = Comic::where('id', $query)
    //         ->orWhere('title', 'LIKE', "%{$query}%")
    //         ->first(); // Lấy sản phẩm đầu tiên phù hợp
    
    //     if ($comic) {
    //         // Chuyển hướng đến trang chi tiết sản phẩm
    //         return redirect()->route('client.show', $comic->id);
    //     }
    
    //     // Nếu không tìm thấy sản phẩm, thêm thông báo vào session
    //     return redirect()->route('client.products.index')->with('error', 'Sản phẩm không tìm thấy.');
    // }

    // public function dashboard()
    // {
    //     // Logic cho dashboard
    //     return view('client.dashboard'); // Trả về view dashboard
    // }
}
