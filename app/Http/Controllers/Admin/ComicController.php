<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comic;
use App\Models\Category;
use App\Models\Author;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

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
            'title' => 'required|string|max:255', // Tiêu đề là bắt buộc
            'category_id' => 'nullable|exists:categories,id', // Danh mục phải tồn tại
            'description' => 'nullable|string', // Mô tả có thể null
            'publication_date' => 'nullable|date', // Ngày xuất bản phải là định dạng ngày
            'price' => 'nullable|numeric|gt:0|lt:original_price', // Giá phải lớn hơn 0 và nhỏ hơn giá gốc
            'original_price' => 'required|numeric', // Giá gốc là bắt buộc và phải là số
            'stock_quantity' => 'nullable|integer|min:1', // Số lượng tồn kho phải lớn hơn hoặc bằng 1
        ], [
            'title.required' => 'Không được để trống tên.', // Tùy chỉnh thông báo lỗi
            'title.max' => 'Tiêu đề không được vượt quá 255 ký tự.', // Tùy chỉnh thông báo lỗi cho độ dài tiêu đề
            'price.gt' => 'Giá sản phẩm phải lớn hơn 0.', // Tùy chỉnh thông báo lỗi cho trường giá
            'price.lt' => 'Giá phải nhỏ hơn giá gốc.', // Tùy chỉnh thông báo lỗi cho trường giá
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
        try {
            $comic->delete();
            return redirect()->route('admin.comics.index')->with('success', 'Sản phẩm đã được xóa thành công.');
        } catch (\Exception $e) {
            return redirect()->route('admin.comics.index')->with('error', 'Có lỗi xảy ra: ' . $e->getMessage());
        }
    }

    public function edit(Comic $comic)
    {
        $categories = Category::all(); // Lấy tất cả danh mục
        return view('admin.comics.edit', compact('comic', 'categories')); // Trả về view chỉnh sửa với sản phẩm và danh mục
    }

    public function show(Comic $comic)
    {
        return view('admin.comics.show', compact('comic')); // Trả về view hiển thị chi tiết sản phẩm
    }
}
