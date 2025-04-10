<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Requests\CategoryRequest;

class CategoryController extends Controller
{
    /**
     * Hiển thị danh sách các danh mục.
     */
    public function index(Request $request)
    {
        // Sử dụng Eloquent để truy vấn
        $query = Category::orderBy('id', 'desc');
        if ($request->has('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }
        $categories = $query->paginate(5);
        return view('admin.categories.index', compact('categories'));
    }

    /**
     * Hiển thị form tạo danh mục mới.
     */
    public function create()
    {
        return view('admin.categories.create');
    }

    /**
     * Lưu danh mục mới vào cơ sở dữ liệu.
     */
    public function store(CategoryRequest $request)
    {
        // Sử dụng Eloquent để tạo danh mục
        Category::create($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Thêm thành công');
    }

    /**
     * Hiển thị thông tin chi tiết của danh mục.
     */
    public function show(Category $category)
    {
        // Sử dụng Eloquent để lấy danh mục
        return view('admin.categories.show', compact('category'));
    }

    /**
     * Hiển thị form chỉnh sửa danh mục.
     */
    public function edit(Category $category)
    {
        // Sử dụng Eloquent để lấy danh mục
        return view('admin.categories.edit', compact('category'));
    }

    /**
     * Cập nhật danh mục trong cơ sở dữ liệu.
     */
    public function update(CategoryRequest $request, Category $category)
    {
        // Sử dụng Eloquent để cập nhật danh mục
        $category->update($request->validated());
        return redirect()->route('admin.categories.index')->with('success', 'Cập nhật thành công');
    }

    /**
     * Xóa danh mục khỏi cơ sở dữ liệu.
     */
    public function destroy(Category $category)
    {
        // Sử dụng Eloquent để xóa danh mục
        $category->delete();
        return redirect()->route('admin.categories.index')->with('success', 'Xóa thành công');
    }
}