@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <h1 class="h3">Thêm Sản Phẩm</h1>
    <form action="{{ route('admin.comics.store') }}" method="POST">
            @csrf
        
            @php
                $firstErrorField = collect($errors->keys())->first(); // Lấy trường lỗi đầu tiên
            @endphp
        
            <!-- Tiêu Đề -->
            <div class="mb-3">
                <label for="title" class="form-label">Tiêu Đề</label>
                <input type="text" class="form-control @error('title') is-invalid @enderror" id="title" name="title" 
                    value="{{ old('title') }}" @if ($firstErrorField == 'title') autofocus @endif>
        
                @if ($firstErrorField == 'title')
                    <p class="alert alert-danger mt-1">{{ $errors->first('title') }}</p>
                @endif
            </div>
        
            <!-- Danh Mục -->
            <div class="mb-3">
                <label for="category_id" class="form-label">Danh Mục</label>
                <select class="form-select @error('category_id') is-invalid @enderror" id="category_id" name="category_id">
                    <option value="">Chọn Danh Mục</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" 
                            {{ old('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p class="alert alert-danger mt-1">{{ $message }}</p>
                @enderror
            </div>
        
            <!-- Ngày Xuất Bản -->
            <div class="mb-3">
                <label for="publication_date" class="form-label">Ngày Xuất Bản</label>
                <input type="date" class="form-control @error('publication_date') is-invalid @enderror" id="publication_date"
                    name="publication_date" value="{{ old('publication_date') }}" @if ($firstErrorField == 'publication_date') autofocus @endif>
        
                @if ($firstErrorField == 'publication_date')
                    <p class="alert alert-danger mt-1">{{ $errors->first('publication_date') }}</p>
                @endif
            </div>
        
            <!-- Giá -->
            <div class="mb-3">
                <label for="price" class="form-label">Giá</label>
                <input type="number" class="form-control @error('price') is-invalid @enderror" id="price" name="price"
                    value="{{ old('price') }}" @if ($firstErrorField == 'price') autofocus @endif>
        
                @if ($firstErrorField == 'price')
                    <p class="alert alert-danger mt-1">{{ $errors->first('price') }}</p>
                @endif
            </div>
        
            <!-- Giá Gốc -->
            <div class="mb-3">
                <label for="original_price" class="form-label">Giá Gốc</label>
                <input type="number" class="form-control @error('original_price') is-invalid @enderror" id="original_price"
    name="original_price" value="{{ old('original_price') }}" @if ($firstErrorField == 'original_price') autofocus @endif>
        
                @if ($firstErrorField == 'original_price')
                    <p class="alert alert-danger mt-1">{{ $errors->first('original_price') }}</p>
                @endif
            </div>
        
            <!-- Số Lượng Tồn Kho -->
            <div class="mb-3">
                <label for="stock_quantity" class="form-label">Số Lượng Tồn Kho</label>
                <input type="number" class="form-control @error('stock_quantity') is-invalid @enderror" id="stock_quantity"
                    name="stock_quantity" value="{{ old('stock_quantity') }}" @if ($firstErrorField == 'stock_quantity') autofocus @endif>
        
                @if ($firstErrorField == 'stock_quantity')
                    <p class="alert alert-danger mt-1">{{ $errors->first('stock_quantity') }}</p>
                @endif
            </div>
        
            <!-- Hình Ảnh -->
            <div class="mb-3">
            <label for="image" class="form-label">Tải Ảnh Lên</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*">
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