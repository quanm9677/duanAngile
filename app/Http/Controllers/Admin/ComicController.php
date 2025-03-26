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
            // Xóa dòng này nếu không cần tác giả
            // 'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        // Tạo sản phẩm mới
        Comic::create($request->all());
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được tạo thành công.');
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
            // Xóa dòng này nếu không cần tác giả
            // 'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        // Cập nhật sản phẩm
        $comic->update($request->all());
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Xóa sản phẩm
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}