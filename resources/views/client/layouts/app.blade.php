<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'My Application')</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">
    <!-- Core CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/normalize.css@8.0.0/normalize.min.css">
    <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}"> -->
    @stack('styles')
</head>
<body>
    <header>
        <nav class="navbar navbar-expand-lg navbar-light bg-light">
            <a class="navbar-brand" href="#">BookStore</a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <!-- <div class="collapse navbar-collapse" id="navbarNav">
                <form method="GET" action="{{ route('client.comics.index') }}" class="d-flex my-2 my-lg-0 me-1" style="flex-grow: 1; margin-left: 80px;">
                    <input type="hidden" name="act" value="search">
                    
                 
                    <div class="form-group">
                        <input type="text" name="search" id="search" class="form-control" placeholder="Tìm kiếm sản phẩm" value="{{ request('search') }}">
                        <div id="suggestions" class="suggestions-list" style="display: none;"></div> 
                    </div>

                    
                    <button class="btn btn-outline-success" type="submit">Tìm kiếm</button>
                </form>
                <div class="d-flex align-items-center ms-3">
                    <a href="#" class="btn btn-light mx-1"><i class="fas fa-bell"></i></a>
                    <a href="#" class="btn btn-light mx-1"><i class="fas fa-shopping-cart"></i></a>
                    <a href="#" class="btn btn-primary mx-1">Đăng nhập</a>
                </div>
            </div> -->
        </nav>
    </header>

    <main>
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <!-- <li class="breadcrumb-item"><a href="#">Trang chủ</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sản phẩm</li> -->
            </ol>
        </nav>
        @yield('content')
    </main>

    <footer>
        <!-- Footer content here -->
    </footer>

    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/jquery@2.2.4/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.4/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
    document.addEventListener("DOMContentLoaded", function() {
        const searchInput = document.getElementById('search');
        const suggestionsList = document.getElementById('suggestions');

        searchInput.addEventListener('input', function() {
            const query = this.value;

            if (query.length > 0) {
                fetch(`/client/products/search?query=${query}`)
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
                                    // Chuyển hướng đến trang chi tiết sản phẩm
                                    window.location.href = `/client/comics/${comics.id}`; // Đảm bảo rằng route này tồn tại
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
                suggestionsList.style.display = 'none'; // Ẩn gợi ý khi click ra ngoài
            }
        });
    });
    </script>
    @stack('scripts')
</body>
</html>