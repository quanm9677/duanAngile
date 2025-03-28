@extends('admin.layouts.app')

@section('content')
<div class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="h3">Danh Sách Sản Phẩm</h1>
        <a href="{{ route('admin.comics.create') }}" class="btn btn-primary">
            <i class="fas fa-plus"></i> Thêm Sản Phẩm
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif

    <div class="card shadow-sm">
        <div class="card-body">
            <table class="table table-hover">
                <thead class="table-light">
                    <tr>
                        <th>Tiêu Đề</th>
                        <th>Danh Mục</th>
                        <th>Giá</th>
                        <th width="280">Hành động</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($comics as $comic)
                    <tr>
                        <td><a href="{{ route('admin.comics.show', $comic) }}">{{ $comic->title }}</a></td>
                        <td>{{ $comic->category->name ?? 'N/A' }}</td>
                        <td>{{ $comic->price }}</td>
                        <td>
                            <a href="{{ route('admin.comics.show', $comic) }}" class="btn btn-sm btn-info me-2">
                                <i class="fas fa-eye"></i> Xem
                            </a>
                            <a href="{{ route('admin.comics.edit', $comic) }}" class="btn btn-sm btn-warning me-2">
                                <i class="fas fa-edit"></i> Sửa
                            </a>
                            <form action="{{ route('admin.comics.destroy', $comic) }}" method="POST" class="d-inline" onsubmit="return confirmDelete();">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger">
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

<script>
    function confirmDelete() {
        return confirm('Bạn có chắc chắn muốn xóa không?');
    }
</script>