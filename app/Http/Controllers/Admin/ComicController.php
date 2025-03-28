<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $comics = Comic::all();
        return view('admin.comics.index', compact('comics'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $categories = Category::all();
        // Xóa dòng này nếu không cần danh sách tác giả
        // $authors = Author::all();
        return view('admin.comics.create', compact('categories')); // Chỉ truyền $categories
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric|lt:original_price',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();

            // Xử lý ảnh
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $data['image'] = $imageName; // Lưu tên file ảnh vào mảng dữ liệu
            }

            Comic::create($data);
            return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được tạo thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.comics.index')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Hiển thị chi tiết sản phẩm
    public function show(Comic $comic)
    {
        return view('admin.comics.show', compact('comic'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Comic $comic)
    {
        $categories = Category::all();
        // Xóa dòng này nếu không cần danh sách tác giả
        // $authors = Author::all();
        return view('admin.comics.edit', compact('comic', 'categories')); // Chỉ truyền $categories
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Comic $comic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric|lt:original_price',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $data = $request->all();

            // Xử lý ảnh
            if ($request->hasFile('image')) {
                $imageName = time() . '.' . $request->image->extension();
                $request->image->move(public_path('images'), $imageName);
                $data['image'] = $imageName; // Lưu tên file ảnh vào mảng dữ liệu
            }

            $comic->update($data);
            return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.comics.index')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    // Xóa sản phẩm
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}