@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh Sách Sản Phẩm</h1>
        <a href="{{ route('admin.comics.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm Sản Phẩm
        </a>
    </div>

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <!-- <th>giá gốc </th> -->
                        <th>Số lượng tồn kho</th>
                        <th>Ảnh</th>
                        <th width="280">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comics as $comic)
                    <tr>
                        <td><a href="{{ route('admin.comics.show', $comic) }}">{{ $comic->title }}</a></td>
                        <td>{{ $comic->category->name ?? 'N/A' }}</td>
                        <td>{{ number_format($comic->price, 0, ',', '.') }} VND</td>
                        <!-- <td>{{ number_format($comic->original_price, 0, ',', '.') }} VND</td> -->
                        <td>{{ $comic->stock_quantity }}</td>
                        <td>
                            @if($comic->image && file_exists(public_path('images/' . $comic->image)))
                            <img src="{{ asset('images/' . $comic->image) }}" alt="{{ $comic->title }}" style="width: 100px; height: auto;">
                            @else
                            <span>Không có ảnh</span>
                            @endif
                        </td>
                        <td>
                            <a href="{{ route('admin.comics.show', $comic) }}" class="btn btn-sm btn-info me-2">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="{{ route('admin.comics.edit', $comic) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.comics.destroy', $comic) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger" onclick="return confirm('Bạn có chắc chắn muốn xóa?')">
                                    <i class="fas fa-trash"></i> Xóa
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection