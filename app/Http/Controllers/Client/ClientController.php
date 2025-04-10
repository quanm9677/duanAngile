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
    $categories = Category::withCount('comics')->get();

    $comics = Comic::with('category')
        ->when($request->filled('category_id'), fn($query) => $query->where('category_id', $request->category_id))
        ->when($request->filled('price_range'), function ($query) use ($request) {
            $priceRange = explode('-', $request->price_range);
            return $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        })
        ->get();

    $bestSellers = Comic::with('category')
        ->when($request->filled('category_id'), function ($query) use ($request) {
            return $query->where('category_id', $request->category_id);
        })
        ->when($request->filled('price_range'), function ($query) use ($request) {
            $priceRange = explode('-', $request->price_range);
            return $query->whereBetween('price', [$priceRange[0], $priceRange[1]]);
        })
        ->orderBy('click_count', 'desc')
        ->take(5)
        ->get();

    if ($request->filled('query')) {
        $comic = Comic::where('title', 'like', '%' . $request->input('query') . '%')->first();
        
        if ($comic) {
            return redirect()->route('client.show', $comic->id);
        }
        
        return redirect()->route('client.index')
            ->with('error', 'Không tìm thấy sản phẩm nào.')
            ->with(compact('categories', 'comics', 'bestSellers'));
    }

    return view('client.index', compact('comics', 'categories', 'bestSellers'));
}
// ... existing code ...

    public function show($id)
    {
        $comic = Comic::with('category')->findOrFail($id);
        
        $comic->increment('click_count');
        $comic->update(['is_featured' => true]);

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