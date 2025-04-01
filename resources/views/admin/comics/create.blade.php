@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">Thêm Sản Phẩm</h1>
    <form action="{{ route('admin.comics.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh Mục</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Chọn Danh Mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description"></textarea>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price">
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Giá Gốc</label>
            <input type="number" class="form-control" id="original_price" name="original_price" required>
        </div>
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="text" class="form-control" id="image" name="image">
        </div>
        
            <button type="submit" class="btn btn-primary">Thêm Sản Phẩm</button>
        </form>
</div>

<script>
    function validateForm() {
        var title = document.getElementById('title').value;
        if (title.trim() === '') {
            alert('Vui lòng nhập tên sản phẩm.');
            return false;
        }
        return true;
    }
</script>
@endsection