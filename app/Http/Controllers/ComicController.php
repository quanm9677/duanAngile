<?php

namespace App\Http\Controllers;

use App\Models\Comic;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;

class ComicController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $comics = Comic::with(['author', 'category'])->get();
        return view('comics.index', compact('comics'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('comics.create', compact('categories', 'authors'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        Comic::create($request->all());
        return redirect()->route('comics.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    // Hiển thị chi tiết sản phẩm
    public function show(Comic $comic)
    {
        return view('comics.show', compact('comic'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Comic $comic)
    {
        $categories = Category::all();
        $authors = Author::all();
        return view('comics.edit', compact('comic', 'categories', 'authors'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Comic $comic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'author_id' => 'nullable|exists:authors,id',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer',
            'image' => 'nullable|string',
        ]);

        $comic->update($request->all());
        return redirect()->route('comics.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Xóa sản phẩm
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('comics.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}