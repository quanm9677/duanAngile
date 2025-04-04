@extends('client.layouts.app')

@section('content')

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif

<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Cửa Hàng</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="{{ route('client.dashboard') }}">Trang chủ</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">Sản phẩm</p>
        </div>
    </div>
</div>
<!-- Page Header End -->

<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Bộ lọc sản phẩm Start -->
        <div class="col-12 mb-4">
            <h5 class="font-weight-semi-bold mb-4">Bộ lọc sản phẩm</h5>
            <form method="GET" action="{{ route('client.index') }}">
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Danh mục</h6>
                    <select name="category_id" class="form-control">
                        <option value="">Tất cả danh mục</option>
                        @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ request('category_id') == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                        @endforeach
                    </select>
                </div>
                <div class="border-bottom mb-4 pb-4">
                    <h6 class="font-weight-semi-bold mb-3">Khoảng giá</h6>
                    <select name="price_range" class="form-control">
                        <option value="">Tất cả giá</option>
                        <option value="0-50000">Dưới 50,000đ</option>
                        <option value="50000-100000">50,000đ - 100,000đ</option>
                        <option value="100000-200000">100,000đ - 200,000đ</option>
                        <option value="200000-500000">200,000đ - 500,000đ</option>
                        <option value="500000-999999999">Trên 500,000đ</option>
                    </select>
                </div>
                <div class="mb-4">
                    <button type="submit" class="btn btn-primary btn-block">
                        <i class="fa fa-search mr-2"></i>Lọc sản phẩm
                    </button>
                    <a href="{{ route('client.index') }}" class="btn btn-secondary btn-block mt-2">Reset</a> <!-- Nút Reset -->
                </div>
            </form>
        </div>
        <!-- Bộ lọc sản phẩm End -->

        <!-- Shop Product Start -->
        <div class="container-fluid pt-5">
            <h1 class="text-center">Sản phẩm bán chạy</h1>
            <div class="row pb-3">
                <div class="d-flex justify-content-between"> <!-- Hiển thị sản phẩm -->
                    @if($comics->isEmpty()) <!-- Kiểm tra nếu không có sản phẩm -->
                        <div class="alert alert-warning w-100 text-center">
                            Không có sản phẩm nào được tìm thấy.
                        </div>
                    @else
                        @foreach($comics as $comic) <!-- Hiển thị các sản phẩm đã lọc -->
                            <div class="col-lg-3 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ asset('images/' . $comic->image) }}" alt="{{ $comic->title }}">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3" style="height: 100px;">
                                        <h6 class="text-truncate mb-3">{{ $comic->title }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6 class="text-danger">{{ number_format($comic->price, 0, ',', '.') }}đ</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-center bg-light border">
                                        <a href="{{ route('client.show', $comic->id) }}" class="btn btn-sm text-dark p-0">Xem chi tiết</a>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    @endif
                </div> <!-- Kết thúc d-flex -->
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->

<!-- Product List Full Width -->
<div class="container-fluid pt-5">
    <h1 class="text-center">Danh sách Sản phẩm</h1>
    <div class="position-relative">
        <!-- Navigation Arrows -->
        <button id="prev" class="btn btn-secondary position-absolute prev-arrow">
            <i class="fas fa-chevron-left"></i>
        </button>
        <button id="next" class="btn btn-secondary position-absolute next-arrow">
            <i class="fas fa-chevron-right"></i>
        </button>

        <!-- Product List -->
        <div class="product-container">
            <div class="d-flex product-list">
                @if($comics->isEmpty()) <!-- Kiểm tra nếu không có sản phẩm -->
                    <div class="alert alert-warning w-100 text-center">
                        Không có sản phẩm nào được tìm thấy.
                    </div>
                @else
                    @foreach($comics as $comic)
                    <div class="product-item">
                        <div class="card h-100">
                            <img src="{{ asset('images/' . $comic->image) }}" class="card-img-top" alt="{{ $comic->title }}">
                            <div class="card-body d-flex flex-column">
                                <h5 class="card-title">{{ $comic->title }}</h5>
                                <p class="card-text">{{ Str::limit($comic->description, 50) }}</p>
                                <p class="card-text"><strong>Giá: {{ number_format($comic->price, 0, ',', '.') }} VNĐ</strong></p>
                            </div>
                            <div class="card-footer d-flex justify-content-center bg-light border">
                                <a href="{{ route('client.show', $comic->id) }}" class="btn btn-sm text-dark p-0">Xem chi tiết</a>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</div>

<!-- CSS -->
<style>
  .product-container {
        width: 100%;
        overflow: hidden;
        position: relative;
        padding: 10px 20px; /* Adjusted left-right padding */
    }

    .product-list {
        display: flex;
        transition: transform 0.5s ease-in-out;
        margin-left: -20px; /* To compensate for the padding adjustment on the left */
        margin-right: -20px; /* To compensate for the padding adjustment on the right */
    }

    .product-item {
        flex: 0 0 220px;
        margin: 0 10px;
        text-align: center;
    }

    .product-item .card {
        width: 100%;
        height: 320px;
        overflow: hidden;
    }

    .product-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
    }

    .card-title {
        font-size: 14px;
        font-weight: bold;
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .card-text {
        font-size: 12px;
        height: 40px;
        overflow: hidden;
        text-overflow: ellipsis;
    }

    .prev-arrow,
    .next-arrow {
        top: 50%;
        transform: translateY(-50%);
        background-color: rgba(0, 0, 0, 0.5);
        color: white;
        border: none;
        padding: 10px 15px;
        cursor: pointer;
        z-index: 100;
    }

    .prev-arrow {
        left: 0;
    }

    .next-arrow {
        right: 0;
    }

    .prev-arrow.hidden,
    .next-arrow.hidden {
        display: none;
    }

    .alert {
        margin: 20px 0;
    }
</style>

<!-- JavaScript -->
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const prevButton = document.getElementById('prev');
        const nextButton = document.getElementById('next');
        const productList = document.querySelector('.product-list');
        const productItems = document.querySelectorAll('.product-item');
        const itemsPerView = Math.floor(document.querySelector('.product-container').offsetWidth / 220); // Number of items to display based on container width
        let currentIndex = 0; // Index of the first visible product

        // Calculate the total width of the product list
        const totalWidth = productItems.length * 220; // Assuming each item is 220px wide
        const maxScrollWidth = totalWidth - document.querySelector('.product-container').offsetWidth;

        // Function to move the product list left or right
        function moveCarousel(direction) {
            currentIndex += direction;

            if (currentIndex < 0) {
                currentIndex = 0; // Prevent scrolling past the first item
            } else if (currentIndex > productItems.length - itemsPerView) {
                currentIndex = productItems.length - itemsPerView; // Prevent scrolling past the last item
            }

            // Apply the transform property to move the carousel
            const translateX = -currentIndex * 220; // Shift left by the width of one product item
            productList.style.transform = `translateX(${translateX}px)`;

            // Update arrow visibility
            updateArrowVisibility();
        }

        // Add event listeners to the prev and next buttons
        prevButton.addEventListener('click', function() {
            moveCarousel(-1); // Move to the previous set of products
        });

        nextButton.addEventListener('click', function() {
            moveCarousel(1); // Move to the next set of products
        });

        // Hide the prev button if we're at the start, and the next button if we're at the end
        function updateArrowVisibility() {
            if (currentIndex === 0) {
                prevButton.classList.add('hidden'); // Hide the "previous" button at the start
            } else {
                prevButton.classList.remove('hidden'); // Show the "previous" button if not at the start
            }

            if (currentIndex >= productItems.length - itemsPerView) {
                nextButton.classList.add('hidden'); // Hide the "next" button if at the end
            } else {
                nextButton.classList.remove('hidden'); // Show the "next" button if not at the end
            }
        }

        // Initialize arrow visibility
        updateArrowVisibility();
    });
</script>

@endsection