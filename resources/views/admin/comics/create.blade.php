@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Thêm Sản phẩm</h1>
    <form action="{{ route('comics.store') }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="title">Tên</label>
            <input type="text" name="title" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="author_id">Tác giả</label>
            <select name="author_id" class="form-control">
                <option value="">Chọn tác giả</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}">{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control"></textarea>
        </div>
        <div class="form-group">
            <label for="publication_date">Ngày phát hành</label>
            <input type="date" name="publication_date" class="form-control">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" step="0.01">
        </div>
        <div class="form-group">
            <label for="original_price">Giá gốc</label>
            <input type="number" name="original_price" class="form-control" required step="0.01">
        </div>
        <div class="form-group">
            <label for="stock_quantity">Số lượng tồn kho</label>
            <input type="number" name="stock_quantity" class="form-control">
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="text" name="image" class="form-control">
        </div>
        <button type="submit" class="btn btn-success">Lưu</button>
    </form>
</div>
@endsection