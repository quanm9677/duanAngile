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
            <form method="GET" action="{{ route('client.comics.index') }}">
                <input type="hidden" name="act" value="search">
                <form method="GET" action="{{ route('client.comics.search') }}">
                    <input type="text" name="query" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm" value="{{ request('query') }}">
                    <button type="submit" class="btn btn-primary">Tìm kiếm</button>
                </form>
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
                </div>
            </form>
        </div>
        <!-- Bộ lọc sản phẩm End -->

        <!-- Shop Product Start -->
        <div class="container-fluid pt-5">
            <h1 class="text-center">Sản phẩm bán chạy</h1>
            <div class="row pb-3">
                <div class="d-flex justify-content-between"> <!-- Thay đổi ở đây -->
                    @foreach($comics->when(request('category'), function ($query) {
                        return $query->where('category_id', request('category'));
                    })->sortByDesc('click_count') as $comic)
                    <div class="col-lg-2 col-md-4 col-sm-6 pb-1"> <!-- Thay đổi kích thước cột -->
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
        padding: 10px 40px;
    }

    .product-list {
        display: flex;
        transition: transform 0.5s ease-in-out;
    }

    .product-item {
        flex: 0 0 200px;
        margin: 0 10px;
        text-align: center;
    }

    .product-item .card {
        width: 200px;
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
        const searchInput = document.getElementById('search');
        const suggestionsList = document.getElementById('suggestions');

        searchInput.addEventListener('input', function() {
            const query = this.value;

            if (query.length > 0) {
                fetch(`/client/comic/search?query=${query}`)
                    .then(response => response.json())
                    .then(data => {
                        suggestionsList.innerHTML = '';
                        if (data.length > 0) {
                            suggestionsList.style.display = 'block';
                            data.forEach(product => {
                                const item = document.createElement('div');
                                item.className = 'suggestion-item';
                                item.textContent = product.title;
                                item.onclick = function() {
                                    searchInput.value = product.title;
                                    suggestionsList.style.display = 'none';
                                };
                                suggestionsList.appendChild(item);
                            });
                        } else {
                            suggestionsList.style.display = 'none';
                        }
                    });
            } else {
                suggestionsList.style.display = 'none';
            }
        });

        document.addEventListener('click', function(e) {
            if (!suggestionsList.contains(e.target) && e.target !== searchInput) {
                suggestionsList.style.display = 'none';
            }
        });
    });
</script>

@endsection