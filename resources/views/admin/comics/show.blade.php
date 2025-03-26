@extends('admin.layouts.app')

@section('content')
<div class="container">
    <h1>Chi Tiết Sản Phẩm: {{ $comic->title }}</h1>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $comic->title }}</h5>
            <p class="card-text"><strong>Danh Mục:</strong> {{ $comic->category->name ?? 'N/A' }}</p>
            <p class="card-text"><strong>Mô Tả:</strong> {{ $comic->description }}</p>
            <p class="card-text"><strong>Ngày Xuất Bản:</strong> {{ $comic->publication_date }}</p>
            <p class="card-text"><strong>Giá:</strong> {{ $comic->price }}</p>
            <p class="card-text"><strong>Số Lượng Tồn Kho:</strong> {{ $comic->stock_quantity }}</p>
            <img src="{{ asset($comic->image) }}" alt="{{ $comic->title }}" class="img-fluid">
        </div>
    </div>
    <a href="{{ route('admin.comics.index') }}" class="btn btn-secondary mt-3">Quay lại</a>
</div>
@endsection