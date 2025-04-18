@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">Sửa Sản Phẩm</h1>

    <form action="{{ route('admin.comics.update', $comic) }}" method="POST" enctype="multipart/form-data" onsubmit="return validateForm();">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="title" class="form-label">Tiêu Đề</label>
            <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" value="{{ old('title', $comic->title) }}" required>
            @error('title')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="category_id" class="form-label">Danh Mục</label>
            <select class="form-control @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                <option value="">Chọn danh mục</option>
                @foreach($categories as $category)
                <option value="{{ $category->id }}" {{ $comic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
            @error('category_id')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="description" class="form-label">Mô Tả</label>
            <textarea class="form-control @error('description') is-invalid @enderror" id="description" name="description">{{ old('description', $comic->description) }}</textarea>
            @error('description')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="publication_date" class="form-label">Ngày Xuất Bản</label>
            <input type="date" class="form-control @error('publication_date') is-invalid @enderror" id="publication_date" name="publication_date" value="{{ old('publication_date', $comic->publication_date) }}">
            @error('publication_date')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Giá</label>
            <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price" value="{{ old('price', $comic->price) }}">
            @error('price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <!-- <div class="mb-3">
            <label for="original_price" class="form-label">Giá Gốc</label>
            <input type="number" class="form-control @error('original_price') is-invalid @enderror" id="original_price" name="original_price" value="{{ old('original_price', $comic->original_price) }}" required>
            @error('original_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div> -->
        <div class="mb-3">
            <label for="stock_quantity" class="form-label">Số Lượng Tồn Kho</label>
            <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity" name="stock_quantity" value="{{ old('stock_quantity', $comic->stock_quantity) }}">
            @error('stock_quantity')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Hình Ảnh</label>
            <input type="file" class="form-control" id="image" name="image" value="{{ old('image') }}">
        </div>
        <button type="submit" class="btn btn-primary">Cập nhật</button>
    </form>
</div>

<script>
    function validateForm() {
        var title = document.getElementById('title').value;
        if (title.trim() === '') {
            alert('Vui lòng nhập tên sản phẩm.');
            return false; // Ngăn không cho form được gửi
        }
        return true; // Cho phép form được gửi
    }
</script>
@endsection