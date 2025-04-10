<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ComicRequest;
use App\Models\Comic;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ComicController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $comics = Comic::with('category')->orderBy('id', 'desc')->get();
        return view('admin.comics.index', compact('comics'));
    }

    // Hiển thị form tạo sản phẩm mới
    public function create()
    {
        $categories = Category::all();
        return view('admin.comics.create', compact('categories'));
    }

    // Lưu sản phẩm mới
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'publication_date' => 'required|date',
            'price' => 'required|numeric',
            'stock_quantity' => 'required|integer',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'description' => 'nullable|string',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không được dài hơn 255 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ. Vui lòng chọn danh mục có sẵn.',
            'price.required' => 'Giá không được để trống.',
            'price.numeric' => 'Giá phải là một số.',
            'stock_quantity.required' => 'Số lượng tồn kho không được để trống.',
            'stock_quantity.integer' => 'Số lượng tồn kho phải là số nguyên.',
        ]);

        // Lưu hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $validatedData['image'] = $imageName;
        }

        Comic::create($validatedData);
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    // Hiển thị thông tin chi tiết của sản phẩm
    public function show(Comic $comic)
    {
        return view('admin.comics.show', compact('comic'));
    }

    // Hiển thị form chỉnh sửa sản phẩm
    public function edit(Comic $comic)
    {
        $categories = Category::all();
        return view('admin.comics.edit', compact('comic', 'categories'));
    }

    // Cập nhật sản phẩm
    public function update(Request $request, Comic $comic)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required' => 'Không được để trống tên.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'price.required' => 'Giá không được để trống.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
        ]);

        // Lưu hình ảnh nếu có
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->extension();
            $request->image->move(public_path('images'), $imageName);
            $data['image'] = $imageName;
        }

        $comic->update($data);
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    }

    // Xóa sản phẩm
    public function destroy(Comic $comic)
    {
        $comic->delete();
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được xóa thành công.');
    }
}
