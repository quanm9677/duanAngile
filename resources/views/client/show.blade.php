@extends('client.layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row">
                <div class="col-md-6">
                    <img src="{{ asset('images/' . $comic->image) }}" alt="{{ $comic->title }}" class="img-fluid rounded shadow">
                </div>
                <div class="col-md-6">
                    <h1 class="font-weight-bold">{{ $comic->title }}</h1>
                    <p class="text-muted">Danh mục: {{ $comic->category->name }}</p>
                    <p class="text-muted">Mô tả:</p>
                    <p>{{ $comic->description }}</p>
                    <h4 class="text-danger">{{ number_format($comic->price, 0, ',', '.') }}đ</h4>
                    <p class="text-muted">Giá gốc: <del>{{ number_format($comic->original_price, 0, ',', '.') }}đ</del></p>
                    <p class="text-muted">Số lượng tồn kho: {{ $comic->stock }}</p>
                    <div class="mt-4">
                        <div class="d-flex align-items-center">
                            <button class="btn btn-outline-secondary" id="decrease">-</button>
                            <input type="number" id="quantity" value="1" class="form-control mx-2" style="width: 60px;">
                            <button class="btn btn-outline-secondary" id="increase">+</button>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('client.comics.index') }}" class="btn btn-secondary">Quay lại danh sách</a>
                            <!-- <a href="#" class="btn btn-primary">Thêm vào giỏ hàng</a> -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('increase').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        quantityInput.value = parseInt(quantityInput.value) + 1;
    });

    document.getElementById('decrease').addEventListener('click', function() {
        let quantityInput = document.getElementById('quantity');
        if (quantityInput.value > 1) {
            quantityInput.value = parseInt(quantityInput.value) - 1;
        }
    });
</script>
@endsection
