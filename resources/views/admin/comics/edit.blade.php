@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Sửa Sản phẩm</h1>
    <form action="{{ route('comics.update', $comic) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="title">Tên</label>
            <input type="text" name="title" class="form-control" value="{{ $comic->title }}" required>
        </div>
        <div class="form-group">
            <label for="author_id">Tác giả</label>
            <select name="author_id" class="form-control">
                <option value="">Chọn tác giả</option>
                @foreach ($authors as $author)
                    <option value="{{ $author->id }}" {{ $comic->author_id == $author->id ? 'selected' : '' }}>{{ $author->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="category_id">Danh mục</label>
            <select name="category_id" class="form-control">
                <option value="">Chọn danh mục</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}" {{ $comic->category_id == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="description">Mô tả</label>
            <textarea name="description" class="form-control">{{ $comic->description }}</textarea>
        </div>
        <div class="form-group">
            <label for="publication_date">Ngày phát hành</label>
            <input type="date" name="publication_date" class="form-control" value="{{ $comic->publication_date }}">
        </div>
        <div class="form-group">
            <label for="price">Giá</label>
            <input type="number" name="price" class="form-control" value="{{ $comic->price }}" step="0.01">
        </div>
        <div class="form-group">
            <label for="original_price">Giá gốc</label>
            <input type="number" name="original_price" class="form-control" value="{{ $comic->original_price }}" required step="0.01">
        </div>
        <div class="form-group">
            <label for="stock_quantity">Số lượng tồn kho</label>
            <input type="number" name="stock_quantity" class="form-control" value="{{ $comic->stock_quantity }}">
        </div>
        <div class="form-group">
            <label for="image">Hình ảnh</label>
            <input type="text" name="image" class="form-control" value="{{ $comic->image }}">
        </div>
        <button type="submit" class="btn btn-success">Cập nhật</button>
    </form>
</div>
@endsection