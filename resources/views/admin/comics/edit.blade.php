@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Sửa Sản Phẩm</h1>
    <form action="{{ route('admin.comics.update', $comic) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control" id="title" name="title" value="{{ $comic->title }}" required>
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh Mục</label>
            <select class="form-select" id="category_id" name="category_id">
                <option value="">Chọn Danh Mục</option>
                @foreach($categories as $category)
                    <option value="{{ $category->id }}" {{ $comic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control" id="description" name="description">{{ $comic->description }}</textarea>
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" class="form-control" id="publication_date" name="publication_date" value="{{ $comic->publication_date }}">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control" id="price" name="price" value="{{ $comic->price }}">
        </div>
        <div class="mb-3">
            <label for="original_price" class="form-label">Giá Gốc</label>
            <input type="number" class="form-control" id="original_price" name="original_price" value="{{ $comic->original_price }}" required>
        </div>
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" class="form-control" id="stock_quantity" name="stock_quantity" value="{{ $comic->stock_quantity }}">
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="text" class="form-control" id="image" name="image" value="{{ $comic->image }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập Nhật Sản Phẩm</button>
    </form>
</div>
@endsection