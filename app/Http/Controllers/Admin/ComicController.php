<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ComicController extends Controller
{
    // Hiển thị danh sách sản phẩm
    public function index()
    {
        $comics = Comic::with('category')->get();
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
        $validator = Validator::make($request->all(), [
            'title' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'original_price' => 'required|numeric|min:0',
            'stock_quantity' => 'nullable|integer|min:0',
            'category_id' => 'required|exists:categories,id',
        ], [
            'title.required' => 'Tiêu đề không được để trống.',
            'title.max' => 'Tiêu đề không được dài hơn 255 ký tự.',
            'category_id.required' => 'Vui lòng chọn danh mục.',
            'category_id.exists' => 'Danh mục không hợp lệ. Vui lòng chọn danh mục có sẵn.',
            'price.required' => 'Gía không được để trống.',
            'price.numeric' => 'Giá phải là một số.',
            'price.min' => 'Giá không được nhỏ hơn 0.',
            'original_price.required' => 'Giá gốc không được để trống.',
            'original_price.numeric' => 'Giá gốc phải là một số.',
            'original_price.min' => 'Giá gốc không được nhỏ hơn 0.',
            'stock_quantity.integer' => 'Số lượng tồn kho phải là số nguyên.',
            'stock_quantity.min' => 'Số lượng tồn kho không được nhỏ hơn 0.',
        ]);
    
        if ($validator->fails()) {
            return redirect()->back()
                ->withErrors($validator)  
                ->withInput();  
        }
    
        Comic::create($request->all());
        return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được tạo thành công.');
    }

    public function update(Request $request, Comic $comic)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
            'description' => 'nullable|string',
            'publication_date' => 'nullable|date',
            'price' => 'nullable|numeric|gt:0|lt:original_price',
            'original_price' => 'required|numeric',
            'stock_quantity' => 'nullable|integer|min:1',
        ], [
            'title.required' => 'Không được để trống tên.',
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.',
            'price.gt' => 'Giá sản phẩm phải lớn hơn 0.',
            'price.lt' => 'Giá phải nhỏ hơn giá gốc.',
        ]);

        $data = $request->all();

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

    public function edit(Comic $comic)
    {
        $categories = Category::all();
        return view('admin.comics.edit', compact('comic', 'categories'));
    }

    public function show(Comic $comic)
    {
        $comic->load('category');
        return view('admin.comics.show', compact('comic'));
    }
}
