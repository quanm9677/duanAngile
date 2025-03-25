@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Chi tiết Sản phẩm</h1>
    <p><strong>ID:</strong> {{ $comic->id }}</p>
    <p><strong>Tên:</strong> {{ $comic->title }}</p>
    <p><strong>Tác giả:</strong> {{ $comic->author->name ?? 'Chưa có' }}</p>
    <p><strong>Danh mục:</strong> {{ $comic->category->name ?? 'Chưa có' }}</p>
    <p><strong>Mô tả:</strong> {{ $comic->description }}</p>
    <p><strong>Ngày phát hành:</strong> {{ $comic->publication_date }}</p>
    <p><strong>Giá:</strong> {{ number_format($comic->price, 2) }} VNĐ</p>
    <p><strong>Giá gốc:</strong> {{ number_format($comic->original_price, 2) }} VNĐ</p>
    <p><strong>Số lượng tồn kho:</strong> {{ $comic->stock_quantity }}</p>
    <p><strong>Hình ảnh:</strong> <img src="{{ asset($comic->image) }}" alt="{{ $comic->title }}" width="100"></p>
    <a href="{{ route('comics.index') }}" class="btn btn-primary">Quay lại</a>
</div>
@endsection